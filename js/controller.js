var mantaApp = angular.module("mantaApp", []);
mantaApp.controller("mantaController", function($scope, $http){

	$scope.processVote = function(element, vote){
		// console.log("Clicked on upvote");
		// console.log(element.target);
		console.log(vote);
		$http.post('process_vote.php', {
			voteDirection: vote,
			idOfPost: element.target.parentElement.id
		}).then(function successCallback(response){
			// console.dir(element.target.nextElementSibling.innerHTML);
			if(vote == 1){
				element.target.nextElementSibling.innerHTML = response.data;
			}else{
				element.target.previousElementSibling.innerHTML = response.data;
			}
		}, function errorCallback(response){
			console.log(response);
		});
	}
});
