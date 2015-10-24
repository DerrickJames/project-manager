(function() {

	'use strict';

	angular
		.module('projectManager', ['ui.router', 'satellizer'])
		.config(function($stateProvider, $urlRouterProvider, $authProvider) {

			$authProvider.github({
		      	clientId: '14ceda48bc30a9f5acf5'
		    });

			$stateProvider
				.state('auth', {
					url: '/',
					templateUrl: '../views/authView.html',
					controller: 'AuthController'
				})

				.state('repos', {
					url: '/repos',
					templateUrl: '../views/reposView.html',
					controller: 'ReposController'
				});
			$urlRouterProvider.otherwise('/');
		})
})();