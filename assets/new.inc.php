<?
	if($_GET['edit']) {

		$sqlcmd = "select * from award
					join presenter on presenter.presenter_id = award.presenter_id
					join genre on genre.genre_id = award.genre_id
					where award_id = ".$_GET['edit'];
		if($result = $link->query($sqlcmd)->fetch_array(MYSQLI_ASSOC)) {
			if($link->query($sqlcmd)->num_rows > 0) {
				$action = "popup.php?update=".$_GET['edit'];
				$error = 0;
			} else {
				echo '<script> window.onload = function() { msg(\'No award found\',\'error\'); }</script>';
				$error = 1;
			}
		} else {
			echo '<script> window.onload = function() { msg(\'Error connecting to database\',\'error\'); }</script>';
			$action = "popup.php?a=add";
			$error = 1;
		}
		

	} else {
		$action = "popup.php?a=add";
	}

	echo '
		<form action="'.$action.'" method="post" target="the_process">
			<iframe name="the_process" style="display:none;width:0px;height:0px;border:0px"></iframe>
			<div class="toolbar wrapper button" style="margin-top:10px">';
				if($error == 0 && $_GET['edit'])
	echo '
				<a href="?dup='.$_GET['edit'].'" class="btGreen">'.$lang[$_SESSION['lang']]['dup'].'</a>
				<a href="print.php?award_id='.$_GET['edit'].'" class="btBlue">'.$lang[$_SESSION['lang']]['print'].'</a>
				<a href="?del='.$_GET['edit'].';" class="btRed">'.$lang[$_SESSION['lang']]['remove'].'</a>';

	echo '
			</div> 
			<br>
			<h1>'; 

			if($_GET['a'] == 'new')
				echo 'ADD A NEW AWARD';
			else 
				echo 'EDIT AN AWARD';
	echo '
			</h1>
			<div id="msg" style="height:0px;"></div>
			<table width="90%" align="center" cellspacing="5" cellpadding="5">
				<tr>
					<td width="300">
						'.$lang[$_SESSION['lang']]['award_name'].'
					</td>
					<td>
						<input type="text" name="award_name" placeholder="What is the name of this award?" value="'.$result['award_name'].'">
					</td>
				</tr>
				<tr>
					<td width="300">
						'.$lang[$_SESSION['lang']]['award_genre'].'
					</td>
					<td>
						<select name="genre">
							<option value="0">What genre is this award?</option>
							<option value="0">-----------------------------</option>';

								$sqlcmd = "select * from genre order by genre_name asc";
								foreach($link->query($sqlcmd) as $key => $row) { 
									if($result['genre_id'] == $row['genre_id'])
										echo '<option value="'.$row['genre_id'].'" selected>'.$row['genre_name'].'</option>';
									else 
								  		echo '<option value="'.$row['genre_id'].'">'.$row['genre_name'].'</option>';
								} 

	echo '
						</select>
					</td>
				</tr>
				<tr>
					<td>'.$lang[$_SESSION['lang']]['presenter'].'</td>
					<td>
						<select name="presenter">
							<option value="0">Who is the presenter?</option>
							<option value="0">-------------------------</option>';

								$sqlcmd = "select * from presenter order by presenter_name asc";
								foreach($link->query($sqlcmd) as $key => $row) { 
									if($result['presenter_id'] == $row['presenter_id'])
										echo '<option value="'.$row['presenter_id'].'" selected>'.$row['presenter_name'].'</option>';
									else 
										echo '<option value="'.$row['presenter_id'].'">'.$row['presenter_name'].'</option>';
								} 
	echo '
						</select>
					</td>
				</tr>
				<tr>
					<td>'.$lang[$_SESSION['lang']]['grammys_no'].'</td>
					<td>
						<select name="grammys_no" class="date">';
							for($i=54; $i>0; $i--) {
								if($result['grammys_id'] == $i)
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								else
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
	echo '
						</select>
					</td>
				</tr>
				<tr>
					<td>'.$lang[$_SESSION['lang']]['year'].'</td>
					<td>
						<select name="year" class="date">';
							for($i=2014; $i>2000; $i--) {
								if($result['award_year'] == $i)
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								else
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
	echo '
						</select>
					</td>
				</tr>
			</table>

			<div class="toolbar wrapper button" style="margin-top:50px">
				<a href="javascript:void(0);" class="btGreen" onclick="open_modal_window(\'popup.php?a=norminee\');">'.$lang[$_SESSION['lang']]['add_new_nom'].'</a>
			</div>
			<h2>NOMINEEES</h2>
			<div id="nominees">';
			if($error == 0) {
				$sqlcmd = "select * from nominee
							join song on song.song_id = nominee.song_id
							join artist on artist.artist_id = song.artist_id
							join genre on genre.genre_id = song.genre_id
							where award_id = ".$_GET['edit']."
							order by song_title asc";
				foreach($link->query($sqlcmd) as $key => $row) { 
					echo '
						<label id="nominee">
							<div class="toolbar wrapper">
								<a href="?song='.$row['song_id'].'" class="btOrange edit">'.$lang[$_SESSION['lang']]['edit'].'</a>
								<a href="javascript:void(0);" onclick="if(confirm(\'Are you sure to remove this norminee?\')==true) window.location=\'?del_nom='.$row['nominee_id'].'&award_id='.$_GET['edit'].'\';" class="btRed del">'.$lang[$_SESSION['lang']]['del'].'</a>
							</div>
							<input type="radio" '; if($result['winner'] == $row['song_id']) echo 'checked '; echo ' value="'.$row['song_id'].'" name="winner"> <h3>'.$row['song_title'].'</h3>
							<div>
								'.$row['artist_name'].' / '.$row['album'].' / '.$row['genre_name'].' / '.$row['artist_label'].'
							</div>
					</label>';
				}
			}
	echo '				
			</div>
			<div class="submit">
				<input type="submit" value="'; if($_GET['a'] == "new") echo 'ADD'; else echo 'UPDATE'; echo '">
				<input type="reset" value="RESET">
			</div>
		</form>
	';
?>