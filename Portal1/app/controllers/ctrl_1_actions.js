module1.controller('ctrl_1_actions', [ '$scope', '$http', '$modalInstance', 'service1_ctrl_1', 'service_getter_setter1', function ($scope, $http, $modalInstance, service1_ctrl_1, service_getter_setter1) {

    $scope.req_id = service_getter_setter1.req_id;
    $scope.vm_name = service_getter_setter1.vm_name;
    $scope.snap_date = service_getter_setter1.snap_date;





    $scope.fn_req_add = function (insert_entry_data) {

        var config = {
            params: {
                insert_entry_data: insert_entry_data
            }
        };

        $http.post("php/service1_ctrl_1_req_add.php", null, config).success(function(http_response) {

            if (http_response.msg) {
                var data_to_ctrl_1 = http_response.msg;

            }

            $modalInstance.close(data_to_ctrl_1);

        });

    };


    $scope.fn_req_start = function() {

        var config = {
            params: {

                post_entry_data: $scope.req_id
            }
        };

        $http.post("php/st_restore_pre_ps.php", null, config).success(function(data) {


            $modalInstance.close(data.msg);


            if (data.msg) {

                var config = {
                    params: {

                        req_id  : $scope.req_id,
                        state_id: data.state_id

                    }
                };

                 $http.post("php/st_restore_ps.php", null, config)

            }


        });

    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');

    };




    $scope.fn_req_del = function (req_id) {

        var config = {
            params: {
                data: req_id
            }
        };

        $http.post("php/service1_ctrl_1_req_del.php", null, config).success(function(http_response) {


            if (http_response.msg) {
                var data_to_ctrl_1 = http_response.msg;

            }

            $modalInstance.close(data_to_ctrl_1);


        });

    };


}]);

