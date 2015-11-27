(function() {

	'use strict';

	angular
		.module('projectManager')
		.controller('ReposController', function($scope, $http) {
			$scope.repos;
			$scope.error;
			$scope.loading = true;

			$http
				.get('/api/sync/github')
				.then(function(repos) {
                    console.log('Repos: ', repos);

					$scope.loading = false;
					$scope.repos   = repos.data.repos;
				})

				.catch(function(error) {
					$scope.loading = false;
					$scope.error   = error;
				});
		});
})();
