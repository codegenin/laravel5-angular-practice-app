angular.module('cortejando')

    .factory('AuthInterceptor', function ($rootScope, $window, $q, $location) {
        return {
            request: function (config) {
                config.headers = config.headers || {};
                if ($window.sessionStorage.getItem('token')) {
                    config.headers.Authorization = 'Bearer ' + $window.sessionStorage.getItem('token');
                }
                return config || $q.when(config);
            },
            response: function (response) {
                if (response.status === 401) {
                    $location.path('/login'); // Redirect user to login
                }
                // If we have a token stored, log the user in
                $rootScope.token = $window.sessionStorage.getItem('token');
                return response || $q.when(response);
            }
        };
    });
