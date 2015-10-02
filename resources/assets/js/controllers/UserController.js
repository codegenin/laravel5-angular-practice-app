'use strict';

angular.module('cortejando')

    .controller('RegisterController', function ($scope, UserService) {

        // Current Date
        $scope.date = new Date();

        $scope.save = function () {
            var registerData = {
                name: $scope.register.name,
                description: $scope.register.description,
                dob: $scope.register.dob,
                phone: $scope.register.phone,
                gender: $scope.register.gender,
                email: $scope.register.email,
                password: $scope.register.password
            };

            UserService.register(registerData);
        };

        $scope.reset = function () {
            $scope.user = {name: '', description: ''};
        }
    })

    .controller('AuthController', function ($scope, UserService) {
        $scope.signin = function () {
            var credentials = {
                email: $scope.login.email,
                password: $scope.login.password
            };
            UserService.login(credentials);
        };
    })

    .controller('LogoutController', function ($location, UserService) {
        UserService.logout();
    })

    .controller('ProfileController', function ($scope, UserService) {
        UserService.getUser();
    });
