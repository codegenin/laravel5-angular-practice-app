angular.module('cortejando')

    .config( function( $stateProvider, $urlRouterProvider, $locationProvider ,
        $httpProvider) {

        $urlRouterProvider.otherwise('/');

        $stateProvider
            // Home page
            .state('home', {
                url: '/',
                templateUrl: 'pages/home.html',
                controller: 'MainController',
            })
            .state('about', {
                url: '/about',
                templateUrl: 'pages/about.html',
                controller: 'AboutUsController'
            })

        /**
         * User Routes
         */
            .state('register', {
                url: '/register',
                templateUrl: 'pages/user/register.html',
                controller: 'RegisterController'
            })
            .state('login', {
                url: '/login',
                templateUrl: 'pages/user/login.html',
                controller: 'AuthController'
            })
            .state('logout', {
                url: '/logout',
                controller: 'LogoutController'
            })
            .state('profile', {
                url: '/profile',
                templateUrl: 'pages/user/profile.html',
                controller: 'ProfileController'
            })

        $locationProvider.html5Mode(true);

        // Load Auth service as interceptor
        $httpProvider.interceptors.push('AuthInterceptor');
    });