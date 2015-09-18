(function () {

    'use strict';

    angular.module('cortejando', ['ngRoute', 'ngAnimate'])

        .config([
            '$locationProvider',
            '$routeProvider',
            function($locationProvider, $routeProvider) {
                // routes
                $routeProvider
                    .when('/', {
                        templateUrl: 'pages/home.html',
                        controller: 'MainController'
                    })
                    .when('/about', {
                        templateUrl: 'pages/about.html'
                    })
                    .otherwise({
                        redirectTo: '/',
                    });

                $locationProvider.html5Mode(true);
            }
        ]);

}());