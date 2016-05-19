<?

	$error = 0;

	if($_GET['del']) {
	
		$sqlcmd = "DELETE FROM `grammys`.`nominee` WHERE `nominee`.`nominee_id` = ".$_GET['del'];
		if($link->query($sqlcmd)) {
		} else {
			$error = 1;
		}

		$sqlcmd = "DELETE FROM `grammys`.`award` WHERE `award`.`award_id` = ".$_GET['del'];
		if($link->query($sqlcmd)) {
		} else {
			$error = 1;
		}

		if($error == 0) {
			echo 'Ok';
			echo '<meta http-equiv="refresh" content="0; url=index.php" />';
		} else {
			echo 'Error';
		}

	} else if($_GET['del_nom'] && $_GET['award_id']) {

		$sqlcmd = "DELETE FROM `grammys`.`nominee` WHERE `nominee`.`nominee_id` = ".$_GET['del_nom'];
		if($link->query($sqlcmd)) {
		} else {
			$error = 1;
		}
		
		if($error == 0) {
			echo 'Ok';
			echo '<meta http-equiv="refresh" content="0; url=index.php?edit='.$_GET['award_id'].'" />';
		} else {
			echo 'Error';
		}
	}

?>