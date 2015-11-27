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
