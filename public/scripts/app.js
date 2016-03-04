(function() {

  'use strict';

  angular
  .module('authApp', ['ui.router','ngSanitize', 'satellizer', 'angularMoment'])
  .config(function($stateProvider, $urlRouterProvider, $authProvider, $locationProvider, $httpProvider) {


    // Satellizer configuration that specifies which API
    // route the JWT should be retrieved from
    $authProvider.loginUrl = '/api/authenticate';

    // Redirect to the auth state if any other states
    // are requested other than users
    $urlRouterProvider.otherwise('/home');

    $stateProvider
    .state('home', {
      url: '/home',
      templateUrl: '../views/homeView.html',
      controller: 'MainController as home'
    })
    .state('login', {
      url: '/login',
      templateUrl: '../views/authView.html',
      controller: 'AuthController as auth'
    })
    .state('dashboard', {
      url: '/dashboard',
      templateUrl: '../views/dashboardView.html',
      controller: 'DashboardController'
    })
    .state('post', {
      url: '/post/:postId',
      templateUrl: '../views/postView.html',
      controller: 'PostController'
    })
    .state('users', {
      url: '/users',
      templateUrl: '../views/userView.html',
      controller: 'UserController as user'
    });
    // use the HTML5 History API
    // $locationProvider.html5Mode(true);
    // $httpProvider.interceptors.push('authInterceptor');

  });

})();
