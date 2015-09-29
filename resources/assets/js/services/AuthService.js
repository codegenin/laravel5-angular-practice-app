'use strict';

angular.module('cortejando')
    .factory('UserService',
    function ($rootScope, AuthTokenService, $http, $q, $location) {

        return {
            login: login,
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
        function login() {
            return $http.get(configData.apiBaseUrl + configData.tokenPath, {}).then(function success(response) {
                AuthTokenService.setToken(response.data.token);
                $location.url(configData.basePath);
                $rootScope.token = AuthTokenService.getToken();
                return true;
            });
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