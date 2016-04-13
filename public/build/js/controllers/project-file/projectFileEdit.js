angular.module('app.controllers')
    .controller('ProjectFileEditController',
        ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                
                $scope.projectNote = ProjectNote.get({
                id: $routeParams.id,
                idNote: $routeParams.idNote}); //pegando Projeto

               
                $scope.save = function () {
                    if ($scope.form.$valid) {
                        console.log($scope.projectNote);
                        ProjectNote.update({id: null, idNote: $scope.projectNote.id}, 
                            $scope.projectNote, function () {
                            $location.path('/project/'+ $routeParams.id + '/notes');
                        });
                    }
                }
            }]);