/**
* app Module
* Description
*/
var app = angular.module('app', ['ngRoute','angular-oauth2','app.controllers',
  'app.services', 'app.filters','ui.bootstrap.typeahead',
  'ui.bootstrap.datepicker','ui.bootstrap.tpls','ngFileUpload']);

angular.module('app.controllers',['ngMessages','angular-oauth2']);
angular.module('app.filters',[]);
angular.module('app.services',['ngResource']);



app.provider('appConfig',['$httpParamSerializerProvider', function($httpParamSerializerProvider) {
	var config = {
		baseUrl: 'http://localhost:8000',
    project:{
      status: [
      {value:1, label: "Não Iniciado"},
      {value:2, label: "Iniciado"},
      {value:3, label: "Concluido"}
      ]
    },
    urls: {
      projectFile: '/project/{{id}}/file/{{idFile}}'
    },
    utils:{
           transformRequest: function(data){
             if(angular.isObject(data)){
                 return $httpParamSerializerProvider.$get()(data);
             }
               return data;
           },
           transformResponse: function(data, headers){
               var headersGetter = headers();
               if(headersGetter['content-type'] =='application/json' ||
                   headersGetter['content-type'] == 'text/json') {
                   var dataJson = JSON.parse(data);
                   if(dataJson.hasOwnProperty('data')){
                       dataJson = dataJson.data;
                   }
                   return dataJson;
               }
               return data;
           }
       }
   } ;

	return {
		config: config,
		$get: function() {
			return config;
		}
	}
}]);

app.config(['$routeProvider','$httpProvider','OAuthProvider','OAuthTokenProvider','appConfigProvider',
  function($routeProvider,$httpProvider,OAuthProvider,OAuthTokenProvider,appConfigProvider) {
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $httpProvider.defaults.transformRequest = appConfigProvider.config.utils.transformRequest;
    $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;
    $routeProvider
	.when('/auth/login', {
		templateUrl: 'build/views/login.html',
		controller: 'LoginController'
	})
	.when('/clients', {
		templateUrl: 'build/views/client/clientList.html',
		controller: 'ClientListController'
	})
	.when('/clients/new', {
		templateUrl: 'build/views/client/clientNew.html',
		controller: 'ClientNewController'
	})
	.when('/clients/:id/edit', {
		templateUrl: 'build/views/client/clientEdit.html',
		controller: 'ClientEditController'
	})
	.when('/clients/:id/remove', {
		templateUrl: 'build/views/client/clientRemove.html',
		controller: 'ClientRemoveController'
	})
	.when('/home', {
		templateUrl: 'build/views/home.html',
		controller: 'HomeController'
	})
	.when('/auth/register', {
		templateUrl: 'build/views/home.html',
		controller: 'HomeController'
	})
    //Rotas Projects 
  .when('/projects', {
    templateUrl: 'build/views/projects/list.html',
    controller: 'ProjectListController'
  })
  .when('/projects/new', {
    templateUrl: 'build/views/projects/new.html',
    controller: 'ProjectNewController'
  })
  .when('/projects/:id/show', {
    templateUrl: 'build/views/projects/show.html',
    controller: 'ProjectShowController'
  })
  .when('/projects/:id/edit', {
    templateUrl: 'build/views/projects/edit.html',
    controller: 'ProjectEditController'
  })
  .when('/projects/:id/remove', {
    templateUrl: 'build/views/projects/remove.html',
    controller: 'ProjectRemoveController'
  })
	// Project Notes
  .when('/project/:id/notes', {
    templateUrl: 'build/views/project-note/list.html',
    controller: 'ProjectNoteListController'
  })
  .when('/project/:id/notes/:idNote/show', {
    templateUrl: 'build/views/project-note/show.html',
    controller: 'ProjectNoteShowController'
  })
  .when('/project/:id/notes/new', {
    templateUrl: 'build/views/project-note/new.html',
    controller: 'ProjectNoteNewController'
  })
  .when('/project/:id/notes/:idNote/edit', {
    templateUrl: 'build/views/project-note/edit.html',
    controller: 'ProjectNoteEditController'
  })
  .when('/project/:id/notes/:idNote/remove', {
    templateUrl: 'build/views/project-note/remove.html',
    controller: 'ProjectNoteRemoveController'
  })

  // Project Files
  .when('/project/:id/file', {
    templateUrl: 'build/views/project-file/list.html',
    controller: 'ProjectFileListController'
  })
  .when('/project/:id/file/:idNote/show', {
    templateUrl: 'build/views/project-file/show.html',
    controller: 'ProjectFileShowController'
  })
  .when('/project/:id/file/new', {
    templateUrl: 'build/views/project-file/new.html',
    controller: 'ProjectFileNewController'
  })
  .when('/project/:id/file/:idNote/edit', {
    templateUrl: 'build/views/project-file/edit.html',
    controller: 'ProjectFileEditController'
  })
  .when('/project/:id/file/:idNote/remove', {
    templateUrl: 'build/views/project-file/remove.html',
    controller: 'ProjectFileRemoveController'
  });
	OAuthProvider.configure({
      baseUrl: appConfigProvider.config.baseUrl,
      clientId: 'appid1',
      clientSecret: 'secret', // optional
      grantPath: '/oauth/access_token'
    });
    OAuthTokenProvider.configure({
  		name: 'token',
  		options: {
    		secure: false
  		}
	});
}]);

app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function(event, rejection) {
      // Ignore `invalid_grant` error - should be catched on `LoginController`.
      if ('invalid_grant' === rejection.data.error) {
        return;
        
      }

      // Refresh token when a `invalid_token` error occurs.
      if ('invalid_token' === rejection.data.error) {
        return OAuth.getRefreshToken();
        
      }
      
      // Redirect to `/login` with the `error_reason`.
      return $window.location.href = '#/auth/login';  //?error_reason=' + rejection.data.error;
	});
}]);