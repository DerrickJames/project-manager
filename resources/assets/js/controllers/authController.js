(function() {

	'use strict';

	angular
		.module('projectManager')
		.controller('AuthController', function($scope, $auth, $state) {
			$scope.authenticate = function(provider) {
				$auth.authenticate(provider)
					.then(function(response) {
						$state.go('repos', {});
					})

					.catch(function(error) {
						console.log('Errors: ', error);
					});
			}
		});
})();