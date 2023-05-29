<!doctype html>
<html lang="en" ng-app="clientApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bingo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/custom.css?v=<?php echo date('YmdHis') ?>">
</head>
<body ng-controller="CommonController" ng-cloak="" ng-init="GetAllGameSessions()">
<div class="container">
    <div class="row mt-30">
        <div class="col">
            <a href="/" class="float-end">Play Game</a>
        </div>
    </div>
    <div>
        <table class="table">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Game Session ID</th>
                    <th scope="col">View</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="GameSessionsValues in GameSessions">
                    <th scope="row">{{$index+1}}</th>
                    <td><span ng-bind="GameSessionsValues.game_sessions"></span></td>
                    <td>
                        <a href="history-view.php?session={{GameSessionsValues.game_sessions}}">View</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </table>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="assets/js/angular.js"></script>
<script type="text/javascript" src="app/app.config.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="app/services/app.services.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="app/controller/common-controller.js?v=<?php echo date('YmdHis') ?>"></script>

</html>