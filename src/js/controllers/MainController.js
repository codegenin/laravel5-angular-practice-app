angular.module('cortejando')

    .controller('MainController', [
        '$scope',
        function ($scope) {
            $scope.home = 'This is the homepage';
        }
    ]);
