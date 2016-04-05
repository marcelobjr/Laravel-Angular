angular.module('app.controllers')
.controller('LoginController', ['$scope','$location','OAuth', 
	function($scope,$location,OAuth)  {
	// body...
	$scope.user = {
		username: '',
		password: ''
	};

	$scope.error = {
		message: '',
		error: false
	};

	$scope.login = function() {
		if($scope.form.$valid) {
		OAuth.getAccessToken($scope.user).then(
		   function() {
			$location.path('clients');
		}, function($data) {
			$scope.error.error = true;
			$scope.error.message = $data.data.error_description;
		});
	}
	};

}]);