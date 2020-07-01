module1.factory('service1_ctrl_2', ['$http', function ($http) {
    return {
        success: function () {
            return $http.get('php/service1_ctrl_2.php').then(function (result) {
                return result.data;
            });
        }
    }

}]);
