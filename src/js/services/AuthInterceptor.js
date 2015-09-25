'use strict';

/**
 * Configuration Service
 */
angular.module('cortejando')
    .factory('ConfigService', function ($window) {
        return {
            basePath: '/',
            apiBaseUrl: 'http://localhost:8000/',
            apiTokenName: 'cortejando',
            apiStorage: checkBrowserStorage(),
            loginPath: '/login',
            tokenPath: '/mock/accessToken.json'
        };

        // Simple fallback to check on what
        // storage does the user browser supports
        function checkBrowserStorage() {
            if (window.localStorage) {
                return $window.localStorage;
            }
            return $window.sessionStorage;
        }
    });

/**
 * Token Service
 */
angular.module('cortejando')
    .factory('AuthTokenService', function ($window, ConfigService) {
        var store = ConfigService.apiStorage;
        var key = ConfigService.apiTokenName;

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