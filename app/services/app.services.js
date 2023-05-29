angular.module("clientApp").factory('HttpRequest', function ($http) {
    return {
        Request: function (url, param) {
            return $http({
                method: 'POST',
                url: url,
                data: $.param(param),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            });
        }
    };
});
