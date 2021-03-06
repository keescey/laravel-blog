(function() {

  'use strict';

  angular
    .module('authApp')
    .controller('PostController', PostController);

  function PostController($http, $scope, $stateParams) {

    if($stateParams.postId) {
      var postId = $stateParams.postId;
    }

    $http.get('api/posts/'+postId).success(function(data) {
      $scope.post = data;
    }).error(function(error) {
      $scope.error = error;
    });
  }

})();
