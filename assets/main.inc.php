<?
	if($_GET['a'] == 'new' || $_GET['edit']) {
		require_once('new.inc.php');
	} else if ($_GET['del'] || $_GET['del_nom']) {
		require_once('del.inc.php');
	} else if ($_GET['dup']) {
		require_once('dup.inc.php');
	}


	
?>