<?
	echo '
		<div class="awards">
	';
		$sqlcmd = "select * from award
					join presenter on presenter.presenter_id = award.presenter_id
					join genre on genre.genre_id = award.genre_id
					order by award_id desc";
	echo '
			<h1>GRAMMYS AWARDS ('.$link->query($sqlcmd)->num_rows.')</h1>
	';
		foreach($link->query($sqlcmd) as $key => $row) { 
			echo '
				<div class="award">
					<div class="toolbar">
						<a href="?edit='.$row['award_id'].'" class="btOrange">'.$lang[$_SESSION['lang']]['edit'].'</a>
						<a href="javascript:void(0);" onclick="if(confirm(\'Are you sure to remove this award?\') == true) window.location=\'?del='.$row['award_id'].'\'" class="btRed">'.$lang[$_SESSION['lang']]['del'].'</a>
					</div>
					<h2>'.$row['award_name'].'</h2>
					<h3>'; 
						$sqlcmd2 = "select * from song
									join artist on artist.artist_id = song.artist_id
									where song_id = ".$row['winner'];
						if($result = $link->query($sqlcmd2)->fetch_array(MYSQLI_ASSOC)) {
							echo $result['song_title']. ' by '. $result['artist_name'];
						}
					echo ' / presented by '.$row['presenter_name'].' / '.$row['genre_name'].' / '.$row['grammys_id'].'th Grammys in '.$row['award_year'].' </h3>
				</div>
			';
		}
	echo '
		</div>
	';
?>