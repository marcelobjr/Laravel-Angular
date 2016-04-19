angular.module('app.controllers')
    .controller('ProjectFileShowController',
        ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                $scope.projectNote = ProjectNote.get({id: $routeParams.id}); //pegando client

                $scope.update = function () {
                    if ($scope.form.$valid) {
                        ProjectNote.update({id: $routeParams.id,}, $scope.projectNote, function () {
                            $location.path('/clients')
                        });
                    }
                }
            }]);