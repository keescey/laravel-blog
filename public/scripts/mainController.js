(function() {

  'use strict';

  angular
    .module('authApp')
    .controller('MainController', MainController);

  function MainController($http, $scope) {

    $http.get('api/posts').success(function(data) {
      $scope.posts = data;
    }).error(function(error) {
      $scope.error = error;
    });
  }

})();
