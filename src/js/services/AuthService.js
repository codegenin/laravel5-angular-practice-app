'use strict';

angular.module('cortejando')
    .factory('UserService',
    function ($rootScope, AuthTokenService, ConfigService, $http, $q, $location) {

        return {
            login: login,
            logout: logout,
            getUser: getUser,
            loggedIn: loggedIn
        };

        // Check if user has the token for restricted routes
        function loggedIn() {
            if (!AuthTokenService.getToken()) {
                $location.url(ConfigService.loginPath);
            }
            return true;
        }

        // Login a user
        function login() {
            return $http.get(ConfigService.apiBaseUrl + ConfigService.tokenPath, {}).then(function success(response) {
                AuthTokenService.setToken(response.data.token);
                $location.url(ConfigService.basePath);
                $rootScope.token = AuthTokenService.getToken();
                return true;
            });
        }

        // Removes the token
        function logout() {
            AuthTokenService.setToken();
            $rootScope.token = '';
            $location.url(ConfigService.loginPath);
        }

        // Get user information
        function getUser() {
            if (AuthTokenService.getToken()) {
                $http.get(ConfigService.apiBaseUrl + ConfigService.tokenPath)
                    .then(function (response) {
                        $rootScope.uname = response.data.user.name;
                    });
            } else {
                $q.reject({data: 'client has no auth token'});
                $location.path(ConfigService.loginPath); // Redirect to login
            }
        }
    });