<?php
	require_once 'includes/db_connect.php';

	if(!isset($_SESSION['username'])){
		print "notLoggedIn";
		exit;
	}else{

		$json_received = file_get_contents('php://input');
		$decoded_json = json_decode($json_received, true);
		$post_id = $decoded_json['idOfPost'];
		$vote_direction = $decoded_json['voteDirection'];

		$did_vote = DB::query("SELECT * FROM votes WHERE username = %s AND pid = %i", $_SESSION['username'], $post_id);

// print json_encode($did_vote);
// exit;

		if(DB::count() != 0){
			//We found a record. This person has voted on this post before.

			//If they upvoted and have already upvoted...
			if(($vote_direction == 1) && ($did_vote[0]['vote_direction'] == 1)){
				print 'alreadyVoted';
				exit;

			//if they downvoted and have already downvoted
			}else if(($vote_direction == -1) && ($did_vote[0]['vote_direction'] == -1)){
				print 'alreadyVoted';
				exit;
			}else{
				DB::update('votes', array(
	  				'vote_direction' => $vote_direction
	  			), "username=%s", "pid=%i", $_SESSION['username'], $post_id);
			}
		}else{
			DB::insert('votes', array(
				'username' => $_SESSION['username'],
				'vote_direction' => $vote_direction,
				'pid' => $post_id
			));
		}

		$total_votes = DB::query("SELECT SUM(vote_direction) AS voteTotal FROM votes WHERE pid =".$post_id);

		print json_encode(intval($total_votes[0]['voteTotal']));
	}

