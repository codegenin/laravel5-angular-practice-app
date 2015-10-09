'user strick';

angular.module('cortejando')
    .service('DateService', function ($http) {
        return {
            all: function () {
                //get all dates
                var request = $http.get(configData.apiBaseUrl + configData.datesPath)
                return request;
            },
            create: function (data) {

            },
            get: function (id) {
                var request = $http.get(
                    configData.apiBaseUrl +
                    configData.datesPath + '/' + id)
                return request;
            },
            update: function (data) {

            },
            delete: function (id) {
            }
        }
    });