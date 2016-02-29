(function() {

  'use strict';

  angular
  .module('authApp')
  .controller('AuthController', AuthController);

  function AuthController($auth, $state, $scope) {
    var vm = this;

    $scope.login = function(auth) {
      var credentials = {
        email: vm.email,
        password: vm.password
      }

      // Use Satellizer's $auth service to login
      $auth.login(credentials).then(function(data) {
        // If login is successful, redirect to the users state
        $state.go('users');

      }, function(error) {
        if(error.data.error == 'invalid_credentials') {
          $scope.errorMsg = 'Invalid Credentials.';
        }
      });
    }

  }

})();
