// (function() {
// 	'use strict';

// 	angular
// 		.module('projectManager')
// 		.service('reposDataService', function($http) {
// 			var getRepos = function() {
// 				return $http.get('/sync/github')
// 					.then(function(repos) {
// 						console.log('Repos: ', repos);
// 						return repos;
// 				})

// 				.catch(function(error) {
// 					console.log('Error: ', error);
// 				});
// 			} 

// 			return { getRepos: getRepos };

// 		});
// })();
