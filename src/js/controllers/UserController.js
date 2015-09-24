angular.module('cortejando')

    .controller('RegisterController', function($scope) {

        // Current Date
        $scope.date = new Date();

        $scope.save = function() {
            alert('Data has been save!');
        };

        $scope.reset = function() {
            $scope.user = { name: '', description: '' };
        }
    })

    .controller('AuthController', function ($scope, $http, $window, $location) {
        $scope.signin = function(user) {

            $http.get('http://localhost:8000/mock/accessToken.json', user)
                .success(function (data) {
                    // Stores the token until the user closes the browser window.
                    $window.sessionStorage.setItem('token', data.token);
                    $location.path('/');
                })
                .error(function () {
                    $window.sessionStorage.removeItem('token');
                    // TODO: Show something like "Username or password invalid."
                    // At the moment, this is not needed cause we need a
                    // backend service
                });
        };
    })

    .controller('LogoutController', function($location, $window){
        $window.sessionStorage.removeItem('token');
        $window.sessionStorage.removeItem('uname');

        $location.path('/login');
    })

    .controller('ProfileController', function ($scope, $http, $location, $window) {

        // Simple POST request example (passing data) :
        $http.get('http://localhost:8000/mock/accessToken.json', {msg:'hello word!'}).
            then(function(response) {
                var token = $window.sessionStorage.getItem('token');

                // Check if token is good
                if(!token || token !== response.data.token) {
                    $location.path('/login'); // Redirect to login
                }

                $scope.uname = response.data.user.name;
            }, function(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
            });
    });
