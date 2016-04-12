angular.module('app.controllers')
    .controller('ProjectListController',['$scope','Project','Client','appConfig',
    	function($scope,Project,Client,appConfig){
        $scope.projects = Project.query();
        //$scope.clients  = Client.query();
        //$scope.status   = appConfig.projects.status;

    }]);