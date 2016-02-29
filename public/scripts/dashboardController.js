(function() {

  'use strict';

  angular
    .module('authApp')
    .controller('DashboardController', DashboardController);

  function DashboardController($http, $scope) {

    $http.get('api/posts').success(function(data) {
      console.log('data', data);
      $scope.posts = data;
    }).error(function(error) {
      $scope.error = error;
    });

    $scope.edit = function(post){
      alert(post.title);
    }
    $scope.delete = function(id){
      if(id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
          $http.delete('api/posts/delete/'+id).success(function(data) {
            location.reload();
          }).error(function(error) {
            alert('Unable to delete');
          });

        } else {
          return false;
        }

      } else {
        return false;
      }
    }
  }

})();
