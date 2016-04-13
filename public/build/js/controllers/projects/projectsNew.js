angular.module('app.controllers')
    .controller('ProjectNewController',
    ['$scope','$location','$cookies','Project','Client','appConfig',
    function($scope,$location,$cookies,Project,Client,appConfig){
        
        $scope.projects = new Project();
        $scope.status   = appConfig.project.status;

        $scope.due_date = {
        status: {
            opened: false
        }
        };

        $scope.open = function($event) {
        $scope.due_date.status.opened = true;
        };


        $scope.save = function () {
            if($scope.form.$valid){
                $scope.projects.owner_id = $cookies.getObject('user').id;
            $scope.projects.$save().then(function(){
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