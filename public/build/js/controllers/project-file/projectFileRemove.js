angular.module('app.controllers')
    .controller('ProjectFileRemoveController',
        ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                $scope.projectNote = ProjectNote.get({
                id: $routeParams.id,
                idNote: $routeParams.idNote
                }); //pegando client

                $scope.remove = function () {
                    $scope.projectNote.$delete({id:$scope.projectNote.idNote, idNote:$scope.projectNote.id
                    }).then(function () {
                        $location.path('/project/'+ $routeParams.id + '/notes')
                    });
                }
            }]);