'user strict';

angular.module('cortejando')

    .controller('DatesAllController', function ($scope, DateService) {
        var getDates = DateService.all();
        getDates.success(function (response) {
            $scope.dates = response.data.original.data;
            console.log($scope.dates);
        })
    });