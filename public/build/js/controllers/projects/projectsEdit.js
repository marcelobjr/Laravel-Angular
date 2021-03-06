angular.module('app.controllers')
    .controller('ProjectEditController',
    ['$scope','$routeParams','$location','$cookies','Project','Client','appConfig',
        function($scope,$routeParams,$location,$cookies,Project,Client,appConfig){
        
        Project.get({id: $routeParams.id},function(data){
            $scope.projects = data;
            $scope.clientSelected = data.client.data;
        });

        $scope.due_date = {
        status: {
            opened: false
        }
        };

        $scope.open = function($event) {
        $scope.due_date.status.opened = true;
        };

        $scope.status   = appConfig.project.status;

        $scope.save = function () {
            if($scope.form.$valid){
                $scope.projects.owner_id = $cookies.getObject('user').id;
            Project.update({id: $scope.projects.id}, $scope.projects,function(){
                $location.path('/projects');
            });
            }
        };

        $scope.formatName = function(model){
            if(model){
                return model.name;
            }
        };

        $scope.getClients = function (name) {
            return Client.query({
                search:name,
                searchFields: 'name:like'
            }).$promise;
        };

        $scope.selectClient = function (item) {
            $scope.projects.client_id = item.id;
        };

    }]);