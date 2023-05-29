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
<body ng-controller="CommonController" ng-cloak="" ng-init='GetGameSessionHistory("<?php echo $_GET['session']?>")'>
<div class="container-fluid">
    <div class="row mt-30">
        <div class="col">
            <a href="history.php" class="float-end">View All Games History</a>
        </div>
    </div>
    <div class="row"><div class="col text-center"><h4 class="welcome">Game History</h4></div></div>
    <div class="row mt-30">
        <div class="col">
            <div class="bingo-card">
                <div class="bingo-card-loading" ng-if="isProcessingBingoCard">Loading...</div>
                <div class="row">
                    <div class="col" ng-repeat="(key, value) in PlayerCard">
                        <div class="row">
                            <div class="col text-center bingo-header"><div>{{key}}</div></div>
                        </div>
                        <div class="row" ng-repeat="CardNumberValues in value">
                            <div class="col text-center">
                                <div class="number-box" ng-if="!isMarked(key, CardNumberValues)">{{CardNumberValues}}</div>
                                <div class="number-box marked" ng-if="isMarked(key, CardNumberValues)">{{CardNumberValues}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="" ng-init='GetBingoNumbersHistory("<?php echo $_GET['session']?>")'>
                <h5 class="text-center">Bingo Numbers</h5>

                <div class="row">
                    <div class="col-1 text-center" ng-repeat="BingoNumbersValues in BingoNumbers">
                        <div class="bingo-balls">{{BingoNumbersValues.letter}}{{BingoNumbersValues.number}}</div>
                    </div>
                </div>
            </div>
        </div>
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