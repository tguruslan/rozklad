var app = angular.module('Timetable', []);

app.controller('FilterController', function($scope, $http) {
    var defaultOption = {id:"",text:"Оберіть значення"};
    var keys = ['faculty_id','okr','speciality','education_form_id','course','group'];

    var api_url = 'https://rozklad.udpu.edu.ua/api';

    keys.forEach((key)=> {
        $scope[key+'Items'] = [];
        $('.'+key).select2({
            placeholder: "Оберіть значення",
            allowClear: true,
            minimumResultsForSearch: -1
        });
    });

    $http({
        method: 'GET',
        url: api_url+'/filter',
        params: {
            type: 'faculty_id'
        }
    })
    .then(function(response) {
        var data = response.data;
        data.unshift(defaultOption);
        $scope.faculty_idItems = data;
    })
    .catch(function(error) {
        console.error('Помилка при отриманні даних з API: ', error);
    });

    var key_index=0;
    keys.forEach((key)=> {
        key_index++;
        var _key = keys[key_index];

        $(document).on('change','.'+key, function (){
            faculty_id=$(".faculty_id").val();
            okr=$(".okr").val();
            speciality_id=$(".speciality").val();
            course=$(".course").val();
            education_form_id=$(".education_form_id").val();

            var filters= {
                faculty_id:{},
                okr:{
                    faculty_id:faculty_id,
                },
                speciality:{
                    faculty_id:faculty_id,
                    okr:okr
                },
                education_form_id:{
                    speciality_id:speciality_id
                },
                course:{
                    speciality_id:speciality_id,
                    education_form_id:education_form_id
                },
                group:{
                    speciality_id:speciality_id,
                    course:course,
                    education_form_id:education_form_id
                },
            };


            $http({
                method: 'GET',
                url: api_url+'/filter',
                params: {
                    type: _key,
                    filters: filters[_key]
                }
            })
            .then(function(response) {
                var data = response.data;
                data.unshift(defaultOption);
                $('.'+key).closest('div').nextAll('div:has(select)').each(function (){
                    if(!$(this).find('select').hasClass(_key)){data=[];}
                    $(this).find('select').empty().select2({
                        data: data,
                        placeholder: "Оберіть значення",
                        allowClear: true,
                        minimumResultsForSearch: -1
                    });
                });
            })
            .catch(function(error) {
                console.error('Помилка при отриманні даних з API: ', error);
            });
        });
    });

    $(document).on('click','.btn',function (){
        var url = window.location.href.split('?')[0];
        var params={
            faculty_id:$(".faculty_id").val(),
            okr:$(".okr").val(),
            speciality:$(".speciality").val(),
            education_form_id:$(".education_form_id").val(),
            course:$(".course").val(),
            group: $(".group").val()
        };

        history.pushState({}, null, url + '?' + Object.keys(params).map(key => key + '=' + params[key]).join('&'));

        $scope.days = [];
        $scope.days_data = [];

        $http({
            method: 'GET',
            url: api_url+'/days',
            params: {
                type: 'student',
                id: params.group
            }
        })
        .then(function(response) {
            var data = response.data;
            $scope.days = data;

            $.each(data, function( key, value ) {
                $http({
                    method: 'GET',
                    url: api_url+'/rozklad',
                    params: {
                        type: 'student',
                        id: params.group,
                        date: key
                    }
                })
                .then(function(response) {
                    $scope.days_data[key]=response.data;
                })
                .catch(function(error) {
                    console.error('Помилка при отриманні даних з API: ', error);
                });
            });

        })
        .catch(function(error) {
            console.error('Помилка при отриманні даних з API: ', error);
        });
    });
});

