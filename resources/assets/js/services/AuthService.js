'use strict';

angular.module('cortejando')
    .factory('UserService',
    function ($rootScope, AuthTokenService, $http, $q, $location) {

        return {
            login: login,
            register: register,
            logout: logout,
            getUser: getUser,
            loggedIn: loggedIn
        };

        // Check if user has the token for restricted routes
        function loggedIn() {
            if (!AuthTokenService.getToken()) {
                $location.url(configData.loginPath);
            }
            return true;
        }

        // Login a user
        function login($credentails) {
            return $http.post(configData.apiBaseUrl + configData.tokenPath, $credentails).then(
                function success(response) {
                    autheticated(response);
                return true;
            });
        }

        // Register a user
        function register($data) {
            return $http.post(configData.apiBaseUrl + configData.registerPath, $data)
                .then(
                function success(response) {
                    autheticated(response);
                }
            )
        }

        // Checks if user is authenticated
        function autheticated(response) {
            if(response.data.token){
                AuthTokenService.setToken(response.data.token);
                $location.url(configData.basePath);
                $rootScope.token = AuthTokenService.getToken();
            } else {
                alert(response.data.error.message);
            }
        }

        // Removes the token
        function logout() {
            AuthTokenService.setToken();
            $rootScope.token = '';
            $location.url(configData.loginPath);
        }

        // Get user information
        function getUser() {
            if (AuthTokenService.getToken()) {
                $http.get(configData.apiBaseUrl + configData.tokenPath)
                    .then(function (response) {
                        $rootScope.uname = response.data.user.name;
                    });
            } else {
                $q.reject({data: 'client has no auth token'});
                $location.path(configData.loginPath); // Redirect to login
            }
        }
    });