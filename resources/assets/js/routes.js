'use strict';

angular.module('cortejando')

    .config( function( $stateProvider, $urlRouterProvider, $locationProvider,
        $httpProvider) {

        $urlRouterProvider.otherwise('/');

        var templatePath = 'templates/';

        $stateProvider
            // Home page
            .state('home', {
                url: '/',
                templateUrl: templatePath + 'pages/home.html',
                controller: 'MainController',
            })
            .state('about', {
                url: '/about',
                templateUrl: templatePath + 'pages/about.html',
                controller: 'AboutUsController'
            })

        /**
         * User Routes
         */
            .state('register', {
                url: '/register',
                templateUrl: templatePath + 'pages/user/register.html',
                controller: 'RegisterController'
            })
            .state('login', {
                url: '/login',
                templateUrl: templatePath + 'pages/user/login.html',
                controller: 'AuthController'
            })
            .state('logout', {
                url: '/logout',
                controller: 'LogoutController'
            })
            .state('profile', {
                url: '/profile',
                templateUrl: templatePath + 'pages/user/profile.html',
                controller: 'ProfileController'
            })

        /**
         * Dates Routes
         */
            .state('dates', {
                url: '/dates',
                templateUrl: templatePath + 'pages/dates/listDates.html',
                controller: 'DatesAllController'
            })
            .state('dates/view', {
                url: '/dates/:id',
                templateUrl: templatePath + 'pages/dates/viewDate.html',
                controller: 'DateViewController'
            })

        $locationProvider.html5Mode(true);

    });