angular.module('app.controllers')
    .controller('ProjectNoteShowController',
        ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                $scope.projectNote = ProjectNote.get({id: $routeParams.id}); //pegando client

                $scope.update = function () {
                    if ($scope.form.$valid) {
                        ProjectNote.update({id: $scope.projectNote.id}, $scope.projectNote, function () {
                            $location.path('/clients')
                        });
                    }
                }
            }]);