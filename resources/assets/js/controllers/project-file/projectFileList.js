angular.module('app.controllers')
    .controller('ProjectFileListController', [
        '$scope', '$routeParams', 'ProjectNote', function ($scope, $routeParams, ProjectNote) {
            $scope.projectNotes = ProjectNote.query({id: $routeParams.id});
        }]);