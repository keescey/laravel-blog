(function() {

  'use strict';

  angular
    .module('authApp')
    .controller('PostsController', PostsController);

  function PostsController($http, $scope) {

    $http.get('api/posts').success(function(data) {
      $scope.posts = data;
    }).error(function(error) {
      $scope.error = error;
    });
  }

})();
