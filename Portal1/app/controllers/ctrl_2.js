module1.controller('ctrl_2',['service1_ctrl_2', '$http', '$scope', 'service_getter_setter1', function (service1_ctrl_2, $http ,$scope, service_getter_setter1) {


    $scope.varStatus = 'ng-isolate-scope active';

    service1_ctrl_2.success().then(function (data) {
        $scope.data = data;
        service_getter_setter1.data_from_scope_ctrl_2 = data;

    });


    $scope.refresh1 = function () {

        service1_ctrl_2.success().then(function (data) {

            $scope.equals = angular.equals(service_getter_setter1.data_from_scope_ctrl_2, data);

            if (!$scope.equals) {

            $scope.data = data;
            service_getter_setter1.data_from_scope_ctrl_2 = data;


            }

        });
    };



    $scope.closeAlert = function(index) {
        $scope.alerts.splice(index, 1);
    };



}]);
