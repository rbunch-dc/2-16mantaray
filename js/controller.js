var mantaApp = angular.module("mantaApp", []);
mantaApp.controller("mantaController", function($scope, $http){

	$scope.processVote = function(element, vote){
		// console.log("Clicked on upvote");
		// console.dir(element.target.children[0].innerHTML);
		// console.log(vote);
		$http.post('process_vote.php', {
			voteDirection: vote,
			idOfPost: element.target.parentElement.id
		}).then(function successCallback(response){
			console.log(response.data);
			// console.dir(element.target.nextElementSibling.innerHTML);
			if(response.data == 'alreadyVoted'){
				//do nothing
			}else if(vote == 1){
				if(response.data == 'notLoggedIn'){
					element.target.nextElementSibling.innerHTML = 'You must be logged in to vote.';
				}else{
					element.target.nextElementSibling.innerHTML = response.data;
				}
			}else if(vote == 0){
				if(response.data == 'notLoggedIn'){
					element.target.previousElementSibling.innerHTML = 'You must be logged in to vote';
				}else{
					element.target.previousElementSibling.innerHTML = response.data;
				}
			}
		}, function errorCallback(response){
			console.log(response);
		});
	}
});
