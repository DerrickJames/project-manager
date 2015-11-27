(function() {

	'use strict';

	angular
		.module('projectManager', ['ui.router', 'satellizer'])
		.config(function($stateProvider, $urlRouterProvider, $authProvider, $httpProvider, $provide, $locationProvider) {

            function requireLoginHook($q, $injector) {
                return {
                    responseError: function(rejection) {
                        var $state        = $injector.get('$state'),

                            errorStatuses = [
                                'token_absent', 'token_invalid',
                                'token_not_provided', 'token_expired'
                            ];
                        
                        angular.forEach(errorStatuses, function(value, key) {
                            if(rejection.data.error === value) {
                                localStorage.removeItem('ProjectManager.currentUser');

                                $state.go('auth');
                            }
                        });

                        return $q.reject(rejection);
                    }
                };
            }

            $provide.factory('requireLoginHook', requireLoginHook);

            $httpProvider.interceptors.push('requireLoginHook');

			$authProvider.github({
				url: '/api/auth/github',
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
            $locationProvider.html5Mode(true);
		})

        .run(function($rootScope, $state) {
            $rootScope.$on('$stateChangeStart', function(event, toState) {
                var userString  = localStorage.getItem('ProjectManager.currentUser'),
                    currentUser = JSON.parse(userString);

                if(currentUser) {
                    $rootScope.authenticated = true;
                    $rootScope.currentUser   = currentUser;

                    if(toState.name === 'auth') {
                        event.preventDefault();

                        $state.go('repos');
                    }
                }
            });
        });
})();

(function() {

	'use strict';

	angular
		.module('projectManager')
		.controller('AuthController', function($scope, $auth, $state, $http, $rootScope) {
            $scope.error;
            $scope.loading = true;

            $scope.authenticate = function(provider) {
				$auth
					.authenticate(provider)
					.then(function(response) {
                        console.log('Response: ', response);
                        return $http.get('/api/auth/user');

					}, function(error) {
                        $scope.loading = false;
                        $scope.error   = error;
                    })

					.then(function(response) {
						console.log('GetResponse: ', response);
                        
                        var user = JSON.stringify(response.data.user);

                        localStorage.setItem('ProjectManager.currentUser', user);

                        $rootScope.authenticated = true;
                        $rootScope.currentUser   = response.data.user;
                        
                        $state.go('repos');
					});
			}

            $scope.logout = function() {
                console.log('Clicked');
                $auth.logout().then(function() {
                    localStorage.removeItem('ProjectManager.currentUser');

                    $rootScope.authenticated = false;
                    $rootScope.currentUser   = null;
                });
            }
		});
})();

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

//# sourceMappingURL=application.js.map
