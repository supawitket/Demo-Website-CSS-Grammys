<?
	$sqlcmd = "select * from award where award_id=".$_GET['dup'];
	if($link->query($sqlcmd)) {
		$sqlcmd = "INSERT INTO `award`(`award_name`, `genre_id`, `grammys_id`, `presenter_id`, `award_year`, `winner`)
					 select award_name, genre_id, grammys_id, presenter_id, award_year,winner from award where award_id=".$_GET['dup'];
		if($result = $link->query($sqlcmd)) {
			$last_id = $link->insert_id;

			$sqlcmd = "INSERT INTO `nominee`(`award_id`, `song_id`)
						select '".$last_id."', song_id from nominee where award_id =".$_GET['dup'];
			if($link->query($sqlcmd)) {
				echo '<meta http-equiv="refresh" content="0; url=index.php?edit='.$last_id.'" />';
			}
		}
	} else {
		echo 'Error';
	}
?>