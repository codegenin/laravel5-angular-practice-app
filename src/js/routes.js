angular.module('cortejando').

    config(function($stateProvider, $urlRouterProvider, $locationProvider) {

        $urlRouterProvider.otherwise('/');

        $stateProvider
            // Home page
            .state('home', {
                url: '/',
                templateUrl: 'pages/home.html',
                controller: 'MainController'
            })
            .state('register', {
                url: '/register',
                templateUrl: 'pages/user/register.html',
                controller: 'UserRegisterController'
            })
            .state('about', {
                url: '/about',
                templateUrl: 'pages/about.html',
                controller: 'AboutUsController'
            })

        $locationProvider.html5Mode(true);
    });