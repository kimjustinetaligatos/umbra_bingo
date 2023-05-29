angular.module('clientApp').controller("CommonController", function ($scope, $rootScope, HttpRequest) {

    $UrlPrefix = "/umbra_bingo"
    $scope.GameSession = false;

    $scope.GetGameSessions = function () {
        $scope.isProcessing = true;
        var url = $UrlPrefix + "/api/methods/GetGameSessions.php";
        HttpRequest.Request(url, []).success(function (data) {
            if (data.ErrorCode != 0) {
                alert(data.ErrorMessage);
            } else {
                $scope.GameSession = data.Records.GameSession;
                $scope.PlayerCard = data.Records.PlayerCard;
            }
            $scope.isProcessing = false;
        });
    }

    $scope.SetGameSessions = function (){
        $scope.isProcessing = true;
        var url = $UrlPrefix + "/api/methods/SetGameSessions.php";
        HttpRequest.Request(url, []).success(function (data) {
            if (data.ErrorCode != 0) {
                alert(data.ErrorMessage);
            } else {
                $scope.GameSession = data.Records.GameSession;
                $scope.PlayerCard = data.Records.PlayerCard;
            }
            $scope.isProcessing = false;
        });
    }

    $scope.SetBingoNumber = function (){
        $scope.isProcessing = true;
        var url = $UrlPrefix + "/api/methods/SetBingoNumber.php";
        HttpRequest.Request(url, []).success(function (data) {
            if (data.ErrorCode != 0) {
                alert(data.ErrorMessage);
            } else {
                $scope.BingoNumbers = data.Records.BingoNumbers;
            }
            $scope.isProcessing = false;
        });
    }

    $scope.GetBingoNumbers = function (){
        $scope.isProcessing = true;
        var url = $UrlPrefix + "/api/methods/GetBingoNumbers.php";
        HttpRequest.Request(url, []).success(function (data) {
            if (data.ErrorCode != 0) {
                alert(data.ErrorMessage);
            } else {
                $scope.BingoNumbers = data.Records.BingoNumbers;
            }
            $scope.isProcessing = false;
        });
    }

});
