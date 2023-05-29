angular.module('clientApp').controller("CommonController", function ($scope, $rootScope, HttpRequest) {

    $UrlPrefix = "";//"/umbra_bingo"
    $scope.GameSession = false;
    $scope.MarkedCardNumbersArr = [];

    $scope.GetGameSessions = function () {
        $scope.isProcessing = true;
        var url = $UrlPrefix + "/api/methods/GetGameSessions.php";
        HttpRequest.Request(url, []).success(function (data) {
            if (data.ErrorCode != 0) {
                swal({title: "Error", text: data.ErrorMessage, icon: "error",});
            } else {
                $scope.GameSession = data.Records.GameSession;
                $scope.PlayerCard = data.Records.PlayerCard;
                $scope.MarkedCardNumbersArr = data.Records.MarkedCardNumbersArr;
                if(data.Records.GetGameSessionInfoGameEnded == 1){
                    $scope.isBingo = 1;
                }
            }
            $scope.isProcessing = false;
        });
    }

    $scope.SetGameSessions = function (){
        $scope.isProcessing = true;
        var url = $UrlPrefix + "/api/methods/SetGameSessions.php";
        HttpRequest.Request(url, []).success(function (data) {
            if (data.ErrorCode != 0) {
                swal({title: "Error", text: data.ErrorMessage, icon: "error",});
            } else {
                $scope.GameSession = data.Records.GameSession;
                $scope.PlayerCard = data.Records.PlayerCard;
                $scope.MarkedCardNumbersArr = [];
                $scope.BingoNumbers = [];
                $scope.isBingo = 0;

            }
            $scope.isProcessing = false;
        });
    }

    $scope.SetBingoNumber = function (){
        $scope.isProcessing = true;
        var url = $UrlPrefix + "/api/methods/SetBingoNumber.php";
        HttpRequest.Request(url, []).success(function (data) {
            if (data.ErrorCode != 0) {
                swal({title: "Error", text: data.ErrorMessage, icon: "error",});
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
                swal({title: "Error", text: data.ErrorMessage, icon: "error",});
            } else {
                $scope.BingoNumbers = data.Records.BingoNumbers;
            }
            $scope.isProcessing = false;
        });
    }

    $scope.SetMarkCardNumber = function (letter, number){
        $scope.isProcessingBingoCard = true;
        var url = $UrlPrefix + "/api/methods/SetMarkCardNumber.php";
        $scope.SetMarkCardNumberParam = {};
        $scope.SetMarkCardNumberParam.letter = letter;
        $scope.SetMarkCardNumberParam.number = number;
        HttpRequest.Request(url, $scope.SetMarkCardNumberParam).success(function (data) {
            if (data.ErrorCode != 0) {
                swal({title: "Error", text: data.ErrorMessage, icon: "error",});
            } else {
                //ADD TO MARKED NUMBER
                $scope.MarkedCardNumbersArr.push(letter+''+number);
                if(data.IsBingo){
                    $scope.isBingo = data.IsBingo;
                    swal({title: "Bingo!", text: "Congratulations", icon: "success",});
                }
            }
            $scope.isProcessingBingoCard = false;
        });
    }

    $scope.isMarked = function (letter, number){
        return $scope.MarkedCardNumbersArr.includes(letter+''+number);
    }

});
