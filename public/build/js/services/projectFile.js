angular.module('app.services')
    .service('ProjectFile', ['$resource', 'appConfig','Url', 
        function ($resource, appConfig, Url) {
            var url = appConfig.baseUrl + Url.getUrlResource(appConfig.urls.projectFile);
            console.log(url);
        return $resource(url, {
            id: '@id',
            idFile: '@idFile'
        }, {
            update: {
                method: 'PUT'
            }
        });
    }]);