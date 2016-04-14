angular.module('app.controllers')
    .controller('ProjectFileNewController',
        ['$scope', '$location','$routeParams', 'Upload',
            function ($scope, $location, $routeParams, Upload) {
                //$scope.projectFile = new ProjectFile();
            $scope.projectFile = {
                project_id:$routeParams.id
            };

            Upload.upload({
            url: 'upload/url',
            file: $scope.projectFile.file,
            name: $scope.projectFile.name,
            description: $scope.projectFile.description


        }).then(function (resp) {
            $location.path('/project/'+ $routeParams.id + '/files');
        });

            }]);