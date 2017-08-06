/**
 * Created by bjwsl-001 on 2016/9/5.
 */

//
var app = angular.module('kaifanla', ['ng', 'ngRoute']);

//
app.config(function ($routeProvider) {
    $routeProvider
        .when('/start', {templateUrl: 'tpl/start.html'})
        .when('/main', {templateUrl: 'tpl/main.html',controller:'mainCtrl'})
        .when('/detail', {templateUrl: 'tpl/detail.html'})
        .when('/order', {templateUrl: 'tpl/order.html'})
        .when('/myorder', {templateUrl: 'tpl/myorder.html'})
        .otherwise({redirectTo: '/start'})
})

//����һ����������
app.controller('parentCtrl', function ($scope,$location) {
    $scope.jump = function (path) {
        $location.path(path);
    }
});

//����һ��mainCtrl������
app.controller('mainCtrl', function ($scope,$http) {
    $scope.hasMore = true;
    $http.get('data/dish_getbypage.php?start=0')
        .success(function (data) {
            //console.log(data);
            $scope.dishList = data;
    });
    
    $scope.loadMore = function () {
        $http.get('data/dish_getbypage.php?start='+$scope.dishList.length)
            .success(function (data) {
              $scope.dishList = $scope.dishList.concat(data);
                if(data.length < 5){
                    $scope.hasMore = false;
                }
            })
    }

    $scope.$watch('kw', function () {
        if($scope.kw)
        {
            $http.get('data/dish_getbykw.php?kw='+$scope.kw)
                .success(function (data) {
                    $scope.dishList = data;
                });
        }

    });

});



