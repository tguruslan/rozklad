<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-route.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-resource.js"></script>
    <script src="script.js"></script>
</head>
<body>

<div class="container text-center" ng-app="Timetable" ng-controller="FilterController">
    <div class="row">
        <div class="col-4">
            <select class="faculty_id" style="width: 100%;">
                <option ng-repeat="item in faculty_idItems" value="{{ item.id }}">{{ item.text }}</option>
            </select>
        </div>
        <div class="col-4">
            <select class="okr" style="width: 100%;">
                <option ng-repeat="item in okrItems" value="{{ item.id }}">{{ item.text }}</option>
            </select>
        </div>
        <div class="col-4">
            <select class="speciality" style="width: 100%;">
                <option ng-repeat="item in specialityItems" value="{{ item.id }}">{{ item.text }}</option>
            </select>
        </div>
        <div class="col-4">
            <select class="education_form_id" style="width: 100%;">
                <option ng-repeat="item in education_form_idItems" value="{{ item.id }}">{{ item.text }}</option>
            </select>
        </div>
        <div class="col-4">
            <select class="course" style="width: 100%;">
                <option ng-repeat="item in courseItems" value="{{ item.id }}">{{ item.text }}</option>
            </select>
        </div>
        <div class="col-4">
            <select class="group" style="width: 100%;">
                <option ng-repeat="item in groupItems" value="{{ item.id }}">{{ item.text }}</option>
            </select>
        </div>

        <div class="col-4">
            <div class="btn btn-success" style="width: 100%;">Знайти</div>
        </div>
    </div>
    <div class="">
        <div class="row" ng-repeat="(key, value) in days" id="{{ value }}">
            <h3>{{ value }}</h3>
            <div ng-repeat="(number, data) in days_data[key]" class="col-md-2">
                <div class="card" ng-repeat="(id, lesson) in data">
                    <b>{{ number }} пара</b> <i class="fa fa-clock-o" aria-hidden="true"></i> {{ lesson.time }}
                    <h4>{{ lesson.subject }}</h4>
                    <p class="text-muted">{{ lesson.works_type }}</p>
                    <i class="fa fa-users" aria-hidden="true"></i> {{ lesson.groups }}<br>
                    <i class="fa fa-users" aria-hidden="true"></i> {{ lesson.subgroups }}<br>
                    <i class="fa fa-check-square-o" aria-hidden="true"></i> {{ lesson.form_control }}<br>
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i> {{ lesson.teacher }}<br>
                    <a href="{{ lesson.url }}" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> Посилання</a><br>
                    {{ lesson.comment }}
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
