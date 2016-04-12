angular.module('app.controllers')
    .controller('ProjectEditController',
    ['$scope','$routeParams','$location','$cookies','Project','Client','appConfig',
        function($scope,$routeParams,$location,$cookies,Project,Client,appConfig){
        $scope.projects = Project.get({id: $routeParams.id});
        $scope.clients  = Client.query();
        $scope.status   = appConfig.project.status;

        $scope.save = function () {
            if($scope.form.$valid){
                $scope.projects.owner_id = $cookies.getObject('user').id;
            Project.update({id: $scope.projects.id}, $scope.projects,function(){
                $location.path('/projects');
            });
            }
        }
    }]);