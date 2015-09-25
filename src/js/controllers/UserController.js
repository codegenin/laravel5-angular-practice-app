'use strict';

angular.module('cortejando')

    .controller('RegisterController', function ($scope) {

        // Current Date
        $scope.date = new Date();

        $scope.save = function () {
            alert('Data has been save!');
        };

        $scope.reset = function () {
            $scope.user = {name: '', description: ''};
        }
    })

    .controller('AuthController', function ($scope, UserService) {
        $scope.signin = function () {
            UserService.login();
        };
    })

    .controller('LogoutController', function ($location, UserService) {
        UserService.logout();
    })

    .controller('ProfileController', function ($scope, UserService) {
        UserService.getUser();
    });
