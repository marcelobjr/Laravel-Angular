angular.module('app.controllers')
.controller('HomeController', ['$scope','$cookies', function($scope,$cookies)  {
	// body...
	console.log($cookies.getObject('user').email);
	
}]);