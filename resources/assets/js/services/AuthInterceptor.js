'use strict';

/**
 * Token Service
 */
angular.module('cortejando')
    .factory('AuthTokenService', function ($window) {
        var store = checkBrowserStorage();
        var key = configData.apiTokenName;

        // Storage fullback function
        function checkBrowserStorage() {
            if (window.localStorage) {
                return $window.localStorage;
            }
            return $window.sessionStorage;
        }

        return {
            getToken: getToken,
            setToken: setToken
        };

        // Retrieve the token
        function getToken() {
            return store.getItem(key);
        }

        // Set or remove the token
        function setToken(token) {
            if (token) {
                store.setItem(key, token);
            } else {
                store.removeItem(key);
            }
        }
    });

/**
 * Register the interceptor
 */
angular.module('cortejando')
    .factory('AuthInterceptor', function (AuthTokenService) {

        return {
            request: addToken
        };

        // Add token to request header
        function addToken(config) {
            var token = AuthTokenService.getToken();
            if (token) {
                config.headers = config.headers || {};
                config.headers.Authorization = 'Bearer ' + token;
            }
            return config;
        }
    });

/**
 * Push the AuthInterceptor service
 */
angular.module('cortejando').config(function ($httpProvider) {
    $httpProvider.interceptors.push('AuthInterceptor');
});