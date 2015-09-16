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
                        templateUrl: 'views/home.html',
                        controller: 'MainController'
                    })
                    .when('/about', {
                        templateUrl: 'views/about.html'
                    })
                    .otherwise({
                        redirectTo: '/',
                    });

                $locationProvider.html5Mode(true);
            }
        ]);

}());