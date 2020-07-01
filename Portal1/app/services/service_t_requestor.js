module1.factory('service_t_requestor', ['$http', function ($http) {
    return {
        success: function () {
            //return the promise directly.
            return $http.get('php/service_t_requestor.php').then(function (result) {
                //resolve the promise as the data
                return result.data;
            });
        }
    }
}]);
