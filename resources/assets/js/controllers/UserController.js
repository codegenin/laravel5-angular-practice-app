'use strict';

angular.module('cortejando')

    .controller('RegisterController', function ($scope, AuthService) {

        // Current Date
        $scope.date = new Date();

        $scope.registerData = {};
        $scope.register = function (registerData) {
            AuthService.register(registerData);
        };

        $scope.reset = function () {
            $scope.user = {name: '', description: ''};
        }
    })

    .controller('AuthController', function ($scope, AuthService) {
        $scope.credentials = {};
        $scope.login = function (credentials) {
            AuthService.login(credentials);
        };
    })

    .controller('LogoutController', function ($location, AuthService) {
        AuthService.logout();
    })

    .controller('ProfileController', function ($scope, UserService) {

        $scope.date = new Date();

        var getPost = UserService.get();
        getPost.success(function(response){
            $scope.userData = response;
        });

        $scope.userData = {};
        $scope.update = function(userData){
            var request = UserService.update(userData);
            request.success(function(response){
                $scope.flash = response.status;
            });
        }
    });
