angular.module('cortejando')

    .controller('UserRegisterController', function($scope) {

        // Current Date
        $scope.date = new Date();

        $scope.save = function() {
            alert('Data has been save!');
        };

        $scope.reset = function() {
            $scope.user = { name: '', description: '' };
        }
    });
