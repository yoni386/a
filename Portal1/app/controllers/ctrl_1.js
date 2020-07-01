module1.controller('ctrl_1',['service1_ctrl_1', '$http', '$scope', '$modal', '$log', 'service_getter_setter1', '$interval', function (service1_ctrl_1, $http ,$scope, $modal, $log, service_getter_setter1, $interval) {

    $scope.varRequests = 'ng-isolate-scope active';


    service1_ctrl_1.success().then(function (data) {
        $scope.data = data;
        service_getter_setter1.data_from_scope = data;

    });



    $scope.auto_load_scope = function () {

        service1_ctrl_1.success().then(function (data) {

            $scope.equals = angular.equals(service_getter_setter1.data_from_scope, data);

            if (!$scope.equals) {

                $scope.data = data;
                service_getter_setter1.data_from_scope = data;

            }

        })

    };


    $scope.fn_refresh_auto_scope_value = function () {
        promise = $interval(fn_interval_stop_fn_refresh_auto_scope_value, 1000);
    };



    $scope.refresh = function () {
        $scope.auto_load_scope();
    };




    var promise;

    $scope.fn_refresh_auto_on_off = function (refresh_auto_value) {

        if (refresh_auto_value === 'true') {

            promise = $interval(set_interval1, 1000);
        }

        if (refresh_auto_value === 'false') {

            $scope.stop1();
        }

    };

    // stops the interval
    $scope.stop1 = function() {

        $interval.cancel(promise);
    };

    $scope.$on('$destroy', function() {
        $scope.stop1();
    });


    function set_interval1 () {

        $scope.auto_load_scope();

    }




    $scope.modal_open_add_req = function () {

        var modalInstance = $modal.open({
            templateUrl: 'templates/ctrl_1_modal_open_add_req.html',
            controller: 'ctrl_1_req_add'
        });

        modalInstance.result.then(function (data_from_ctrl_1_req_add) {


            if (data_from_ctrl_1_req_add) {

                $scope.auto_load_scope();

                $scope.alerts = [
                    { type: 'info_custom1', msg: 'New request was created successfully. Request ID ' + data_from_ctrl_1_req_add + ' was created.' }
                ];
            }

            else {

                $scope.alerts = [
                    { type: 'danger_custom1', msg: 'Error has occurred. Please try again and if the problem persists, contact support.' }
                ];
            }

        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };



    $scope.modal_open_edit_req = function (id, vm_name, vm_ds, vol_name, snap_name, snap_date, requestor_name, requestor_email, owner) {


        service_getter_setter1.id              = id;
        service_getter_setter1.vm_name         = vm_name;
        service_getter_setter1.vm_ds           = vm_ds;
        service_getter_setter1.vol_name        = vol_name;
        service_getter_setter1.snap_name       = snap_name;
        service_getter_setter1.snap_date       = snap_date;
        service_getter_setter1.requestor_name  = requestor_name;
        service_getter_setter1.requestor_email = requestor_email;
        service_getter_setter1.owner           = owner;

        var modalInstance = $modal.open({
            templateUrl: 'templates/ctrl_1_modal_open_edit_req.html',
            controller: 'ctrl_1_req_edit'
        });

        modalInstance.result.then(function (data_from_ctrl_1_req_edit) {

            if (data_from_ctrl_1_req_edit) {

                $scope.auto_load_scope();


                $scope.alerts = [
                    { type: 'info_custom1', msg: 'Request ID ' + data_from_ctrl_1_req_edit + ' was modified.' }
                ];
            }

            else {

                $scope.alerts = [
                    { type: 'danger_custom1', msg: 'Error has occurred. Please try again and if the problem persists, contact support.' }
                ];
            }

        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };





    $scope.modal_open_confirm_st_restore = function (param1, param2, param3) {

        service_getter_setter1.req_id    = param1;
        service_getter_setter1.vm_name   = param2;
        service_getter_setter1.snap_date = param3;


        var modalInstance =  $modal.open({
            templateUrl: 'templates/ctrl_1_st_restore.html',
            controller: 'ctrl_1_actions',
            windowClass: 'modal_size_small_2'
        });

        modalInstance.result.then(function (ctrl_1_st_restore) {

            if (ctrl_1_st_restore) {

                $scope.fn_refresh_auto_scope_value();

                $scope.alerts = [
                    { type: 'info_custom1', msg: 'Virtual Machine Restore ID ' + ctrl_1_st_restore + ' has started.' }
                ];
            }

            else {

                $scope.alerts = [
                    { type: 'danger_custom1', msg: 'Error has occurred. Please contact support.' }
                ];
            }

        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };






    $scope.modal_open_fn_req_del = function (req_req_id,req_vm_name) {

        service_getter_setter1.req_id = req_req_id;
        service_getter_setter1.vm_name = req_vm_name;

        var modalInstance =  $modal.open({
            templateUrl: 'templates/ctrl_1_req_del.html',
            controller: 'ctrl_1_actions',
            windowClass: 'modal_size_small_1'
        });

        modalInstance.result.then(function (ctrl_1_req_del) {

            if (ctrl_1_req_del) {


                $scope.alerts = [
                    { type: 'info_custom1', msg: 'Request ID ' + ctrl_1_req_del + ' was deleted successfully.' }
                ];

            }

            else {

                $scope.alerts = [
                    { type: 'danger_custom1', msg: 'Error has occurred. Please try again and if the problem persists, contact support.' }
                ]
            }

            $scope.auto_load_scope();

        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };




    $scope.fn_refresh_auto_scope_value = function () {
        promise = $interval(fn_interval_stop_fn_refresh_auto_scope_value, 1000);
    };


    $scope.fn_stop_fn_refresh_auto_scope_value = function() {
        $interval.cancel(promise);
    };

    $scope.$on('$destroy', function() {
        $scope.fn_stop_fn_refresh_auto_scope_value();
    });



    function fn_interval_stop_fn_refresh_auto_scope_value () {

        service1_ctrl_1.success().then(function (data) {

            $scope.equals = angular.equals(service_getter_setter1.data_from_scope, data);


            if (!$scope.equals) {

                $scope.data = data;
                service_getter_setter1.data_from_scope = data;

            }

            for (var key in data) {

                if (data[key][0] == service_getter_setter1.req_id) {

                    if ($scope.data[key][5] == "2") {

                        $scope.fn_stop_fn_refresh_auto_scope_value();

                        $scope.alerts = [
                            { type: 'info_custom1', msg: 'Virtual Machine Restore ID ' + service_getter_setter1.req_id + ' was completed successfully.' }
                        ];

                    }

                    else if ($scope.data[key][5] == "3") {

                        $scope.fn_stop_fn_refresh_auto_scope_value();

                        $scope.alerts = [
                            { type: 'danger_custom1', msg: 'Virtual Machine Restore ID ' + service_getter_setter1.req_id + ' failed. Contact support.' }
                        ];

                    }


                    break;

                }

            }

        });

    }



    $scope.closeAlert = function(index) {
        $scope.alerts.splice(index, 1);
    };


    $scope.selection_filter_searchText_options = [ { name: 'Any', value: '$' }, { name: 'ID', value: 'req_id' }, { name: 'Snap Date', value: 'snap_date' }, { name: 'Requestor', value: 'requestor_name' }, { name: 'Owner', value: 'owner' }, { name: 'State', value: '1' } ];


    $scope.searchText = {};


    $scope.selection_filter_searchText = $scope.selection_filter_searchText_options[0];

    $scope.fn_clear_selection_filter_searchText = function() {

        $scope.searchText = {};

    };




    $scope.tableRowExpanded = false;
    $scope.tableRowIndexExpandedCurr = "";
    $scope.tableRowIndexExpandedPrev = "";
    $scope.ctrl_1_req_id_expanded = "";

    $scope.ctrl_1_req_id_collapse = [];

//    $scope.dayDataCollapseFn = function () {
//        $scope.ctrl_1_req_id_collapse = [];
//    };


    $scope.fn_ctrl_1_req_id_collapse = function (index, ctrl_1_Id) {
//        if (typeof $scope.ctrl_1_req_id_collapse === 'undefined') {
//            $scope.dayDataCollapseFn();
//        }

        if ($scope.tableRowExpanded === false && $scope.tableRowIndexExpandedCurr === "" && $scope.ctrl_1_req_id_expanded === "") {
            $scope.tableRowIndexExpandedPrev = "";
            $scope.tableRowExpanded = true;
            $scope.tableRowIndexExpandedCurr = index;
            $scope.ctrl_1_req_id_expanded = ctrl_1_Id;
            $scope.ctrl_1_req_id_collapse[index] = true;


        }

        else if ($scope.tableRowExpanded === true) {
            if ($scope.tableRowIndexExpandedCurr === index && $scope.ctrl_1_req_id_expanded === ctrl_1_Id) {
                $scope.tableRowExpanded = false;
                $scope.tableRowIndexExpandedCurr = "";
                $scope.ctrl_1_req_id_expanded = "";
                $scope.ctrl_1_req_id_collapse[index] = false;

            }

            else {
                $scope.tableRowIndexExpandedPrev = $scope.tableRowIndexExpandedCurr;
                $scope.tableRowIndexExpandedCurr = index;
                $scope.ctrl_1_req_id_expanded = ctrl_1_Id;
                $scope.ctrl_1_req_id_collapse[$scope.tableRowIndexExpandedPrev] = false;
//                $scope.ctrl_1_req_id_collapse[$scope.tableRowIndexExpandedPrev] = $scope.tableRowIndexExpandedCurr;
                $scope.ctrl_1_req_id_collapse[$scope.tableRowIndexExpandedCurr] = true;

            }
        }

    };









}]);
