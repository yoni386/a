module1.factory('service1_vm_ds_pl', ['$http', function ($http) {
    return {
        success: function () {
            return $http.get('perl/vm_ds.pl').then(function (result) {
                return result.data;
            });
        }
    }

}]);
