angular.module('app.directives')
.directive('projectFileDownload', ['appConfig','ProjectFile', 
	function(appConfig,ProjectFile){

	return {
		restrict:'E',
		templateUrl: appConfig.baseUrl + '/build/views/templates/projectFileDownload.html',
		link: function(scope,element,attr){

		},
		controller: ['$scope','$attrs','$element',function($scope,$attrs,$element){
			$scope.downloadFile = function() {
				var anchor = $element.children()[0];
				$(anchor).addClass('disabled');
				$(anchor).text('Loading...');
				ProjectFile.download({id: null, idFile:$attrs.idFile}, 
					function(data){

					});
			};
		}]

	}
}]);