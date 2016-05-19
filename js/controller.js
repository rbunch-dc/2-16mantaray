var mantaApp = angular.module("mantaApp", []);
mantaApp.controller("mantaController", function($scope, $http){

	$scope.upVote = function(element){
		// console.log("Clicked on upvote");
		// console.log(element.target);
		$http.post('process_vote.php', {
			voteDirection: 1,
			idOfPost: element.target.parentElement.id
		}).then(function successCallback(response){
			console.log(response.data);
		}, function errorCallback(response){
			console.log(response);
		});
	}
});
