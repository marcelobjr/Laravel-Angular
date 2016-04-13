angular.module('app.controllers')
    .controller('ProjectFileNewController',
        ['$scope', '$location','$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                $scope.projectNote = new ProjectNote();
                $scope.projectNote.project_id = $routeParams.id;

                $scope.save = function () {
                    $scope.projectNote.$save({id: $routeParams.id}).then(function () {
                        $location.path('/project/'+ $routeParams.id + '/notes');
                    });
                }
            }]);