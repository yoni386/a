module1.controller('ctrl_Route1',['$scope', '$route', '$routeParams', '$location', function ($scope, $route, $routeParams, $location) {
    $scope.$route = $route;
    $scope.$location = $location;
    $scope.$routeParams = $routeParams;

}]);



module1.config(function($routeProvider, $locationProvider) {
    $routeProvider

        .when('/requests', {
            templateUrl : 'views/view_ctrl_1.html',
            controller  : 'ctrl_1'
        })

        .when('/status', {
            templateUrl : 'views/view_ctrl_2.html',
            controller  : 'ctrl_2'
        })


        .when('/restore', {
            templateUrl : 'views/view_ctrl_1.html',
            controller  : 'ctrl_1'
        })


        .when('/netapp', {
            templateUrl : 'views/viewCtrl1VolNetappCreate.html',
            controller  : 'ctrl1VolNetappCreate'
        })

        .when('/ibox', {
            templateUrl : 'views/viewCtrl1VolIboxCreate.html',
            controller  : 'ctrl1VolIboxCreate'

        })

        .otherwise ({
            redirectTo: '/restore'
        });


    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });


});


