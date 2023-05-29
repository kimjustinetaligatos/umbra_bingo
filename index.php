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
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body ng-controller="CommonController" ng-cloak="" ng-init="GetGameSessions()">
<div class="container-fluid">
    <div ng-if="!GameSession" class="text-center mt-30">
        <h3>Bingo</h3>
        <button class="btn btn-primary" ng-click="SetGameSessions()">Start Game</button>
    </div>
    <div class="row mt-30" ng-if="GameSession">
        <div class="col">
            <div class="bingo-card">
                <h5 class="text-center">Your Bingo Card</h5>
                <div class="row">
                    <div class="col" ng-repeat="(key, value) in PlayerCard">
                        <div class="row">
                            <div class="col text-center"><span>{{key}}</span></div>
                        </div>
                        <div class="row" ng-repeat="CardNumberValues in value">
                            <div class="col text-center">{{CardNumberValues}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-center">
                <button class="btn btn-primary">Roll Bingo</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/angular.js"></script>
<script type="text/javascript" src="app/app.config.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="app/services/app.services.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="app/controller/common-controller.js?v=<?php echo date('YmdHis') ?>"></script>

</html>