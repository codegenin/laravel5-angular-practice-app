'user strict';

angular.module('cortejando')

    .controller('DatesAllController', function ($scope, DateService) {
        var getDates = DateService.all();
        getDates.success(function (response) {
            $scope.dates = response.data.original.data;
        })
    })
    .controller('DateViewController', function ($scope, $stateParams, DateService) {
        var id = $stateParams.id;
        var getDate = DateService.get(id);
        getDate.success(function (response) {
            $scope.dateData = response.data.original;
            console.log(response.data.original)
        })
    });