module1.factory('service1_ctrl_1', ['$http', function ($http) {
    return {
        success: function () {
            return $http.get('php/service1_ctrl_1_select_join_all.php').then(function (result) {
                return result.data;
            });
        }
    }

}]);
