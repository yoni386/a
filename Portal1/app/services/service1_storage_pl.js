module1.factory('service1_storage_pl', ['$http', function ($http) {
    return {
        success: function (data_vm_ds_input) {

            var config = {
                params: {

                    params_vm_ds_input: data_vm_ds_input
                }
            };

            return $http.get('perl/storage_pl.pl', config).then(function (result) {
                return result.data;
            });
        }
    }

}]);
