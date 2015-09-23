angular.module('cortejando').

    controller('MainController', function($scope, gettextCatalog) {

        gettextCatalog.setcurrentLanguage = 'nl_NL';

        $scope.ChangeLanguage = function (language) {
            gettextCatalog.setCurrentLanguage(language);
        }

        // Current Date
        $scope.date = new Date();

        $scope.save = function() {
            alert('Data has been save!');
        };

        $scope.reset = function() {
            $scope.user = { name: '', description: '' };
        }
    });
