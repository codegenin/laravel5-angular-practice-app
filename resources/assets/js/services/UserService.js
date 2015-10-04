'use strict';

angular.module('cortejando')
    .factory("UserService", function ($http) {

        return {
            all: function () {
                //get all user
            },
            create: function (data) {
                //create a new user
            },
            get: function () {
                //get user information
                var request = $http.get(configData.apiBaseUrl + configData.editProfile);
                return request;
            },
            update: function (data) {
                //update a specific user
                var request = $http.post(configData.apiBaseUrl + '/api/v1/user/update', data)
                return request;
            },
            delete: function (id) {
                //delete a specific user
            }
        }

    });