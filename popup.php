<?
	require("assets/sql.inc.php");
	require("assets/lang.inc.php");
	session_start();
?>
<html>
<head>
	<title>Grammys winners and nominees management</title>
	<style>

		body {
			margin:0px;
			padding:0px;
			background:rgb(245,245,245);
			font-family: 'Helvetica';
			font-weight: 400;
			font-size:16px;
			color:rgba(0,0,0,0.7);
		}
		
		#nominees .btOrange {
			display: none;
		}
		a {
			text-decoration: none;
		}
		input, select, textarea {
			background:rgba(255,255,255,0.5);
			padding:10px 15px;
			color:rgba(0,0,0,0.5);
			border:none;
			border-radius:5px;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.05);
			transition:0.2s;
			min-width: 350px;
			-webkit-appearance:none;
			font-size:15px;
		}
		::-webkit-input-placeholder {
			color:rgba(0,0,0,0.3);
		}
		input:focus,
		select:focus,
		textarea:focus {
			outline: none;
			box-shadow: 0px 0px 0px 5px #dfc498;
		}
		input[type="number"],
		input[type="date"],
		select.date {
			text-align: center;
			min-width: 80px;
		}
		input[type="radio"] {
			padding:0px;
			width:20px;
			min-width: 0px;
			height:20px;
			border-radius: 40px;
		}
		input[type="radio"]:checked {
			box-shadow: 0px 0px 0px 5px #dfc498;
		}
		h1 {
			font-weight: lighter;
			padding:10px 20px;
			margin:0px;
			border-bottom: solid 1px rgba(0,0,0,0.1);
		}
		.button a,
		.btGreen,
		.btRed,
		.btOrange,
		.btBlue {
			color:#FFF;
			font-size:13px;
			padding:7px 15px;
			background:rgba(0,0,0,0.2);
			border-radius: 4px;
			margin-right:10px;
		}
		.btGreen {
			background:#A5C200!important;
		}
		.btRed {
			background:#BA0404!important;
		}
		.btOrange {
			background:#ED7E00!important;
		}
		.btBlue {
			background:#1A8CD9!important;
		}
		#nominees {
			padding:20px;
		}
		#nominees #nominee {
			margin:10px 0px;
			padding:10px;
			background:rgba(255,255,255,0.5);
			display: block;
			border:solid 1px rgba(0,0,0,0.08);
			border-radius:5px;
		}
		#nominees #nominee input {
			position: absolute;
			display: none;
			margin:15px;
		}
		#nominees #nominee h3 {
			padding:15px;
			margin:0px 0px 0px 0px;
			text-indent: 50px;
			border-bottom: solid 1px rgba(0,0,0,0.05);
		}
		#nominees #nominee > div {
			padding:15px 0px 10px 60px;
		}
		#nominee h3 {
			font-weight: lighter;
		}
		.toolbar {
			text-align: right;
			position: absolute;
		}
		.wrapper {
			width:880px;
		}
		.edit, .del {
			display: none;
		}
	</style>
	<script type="text/javascript">
		function add(el) {

			var dupeSelect = el.parentNode.parentNode.cloneNode(true);
			document.getElementById('nominees').appendChild(dupeSelect);

			window.parent.add(dupeSelect);
		}
	</script>
</head>
<body>

	<?
		if($_GET['a'] == 'norminee') {
			echo '
				<h1>NORMINEE LIST</h1>

				<div id="nominees">';
				
				$sqlcmd = "select * from song
							join artist on artist.artist_id = song.artist_id
							join genre on genre.genre_id = song.genre_id
							order by song_title asc";
				foreach($link->query($sqlcmd) as $key => $row) { 
					echo '
						<label id="nominee">
							<div class="toolbar wrapper">
								<a href="javascript:void(0);" onclick="add(this);" class="add btGreen">'.$lang[$_SESSION['lang']]['add'].'</a>
								<a href="javascript:void(0);" class="btOrange edit">'.$lang[$_SESSION['lang']]['edit'].'</a>
								<a href="javascript:void(0);" onclick="del(this);" class="btRed del">'.$lang[$_SESSION['lang']]['del'].'</a>
							</div>
							<input type="hidden" value="'.$row['song_id'].'" name="song_id[]">
							<input type="radio" value="'.$row['song_id'].'" name="winner"> <h3>'.$row['song_title'].'</h3>
							<div>
								'.$row['artist_name'].' / '.$row['album'].' / '.$row['genre_name'].' / '.$row['artist_label'].'
							</div>
						</label>';
				}

			echo '
				</div>
			';
		} else if($_GET['a'] == 'add') {

			if(!empty($_POST['award_name']) && $_POST['genre'] != '0' && $_POST['presenter'] != '0' 
				&& !empty($_POST['song_id'])  && !empty($_POST['winner']) ) {
				$sqlcmd = "INSERT INTO `award`(`award_name`, `genre_id`, `grammys_id`, `presenter_id`, `award_year`, `winner`) 
							VALUES ('".$_POST['award_name']."', '".$_POST['genre']."', '".$_POST['grammys_no']."', '".$_POST['presenter']."', '".$_POST['year']."', '".$_POST['winner']."')";
				if($link->query($sqlcmd)) {
					$last_id = $link->insert_id;

					foreach ($_POST['song_id'] as $key) {
						$sqlcmd = "INSERT INTO `nominee`(`award_id`, `song_id`)
									VALUES ('".$last_id."', '".$key."')";
						$link->query($sqlcmd);
					}
					echo '<script>window.parent.msg(\'Successfully added, edit the award <a href="?edit='.$link->insert_id.'">Click</a>\',\'ok\');</script>';
				}else {
					echo '<script>window.parent.msg(\'Error connecting to database\',\'error\');</script>';
				}
			}else {

				$data = '';

				if(empty($_POST['award_name']))
					$data .= 'Award name, ';
				if($_POST['genre'] == '0')
					$data .= 'Genre, ';
				if($_POST['presenter'] == '0')
					$data .= 'Presenter, ';
				if(empty($_POST['song_id']))
					$data .= 'Nominees, ';
				if(empty($_POST['winner']))
					$data .= 'Winner!';


				echo '<script>window.parent.msg(\'Please fill up all fields: '.$data.'\',\'error\');</script>';
			}

		} else if($_GET['update']) {
			$sqlcmd = "UPDATE `award` SET
						`award_name`='".$_POST['award_name']."',
						`genre_id`='".$_POST['genre']."',
						`grammys_id`='".$_POST['grammys_no']."',
						`presenter_id`='".$_POST['presenter']."',
						`award_year`='".$_POST['year']."',
						`winner`='".$_POST['winner']."' 
						WHERE award_id =  ".$_GET['update'];
			if($link->query($sqlcmd)) {
				foreach ($_POST['song_id'] as $key) {
					$sqlcmd = "INSERT INTO `nominee`(`award_id`, `song_id`)
								VALUES ('".$_GET['update']."', '".$key."')";
					$link->query($sqlcmd);
				}

				echo '<script>window.parent.msg(\'Updated\',\'ok\');</script>';
			} else {
				echo '<script>window.parent.msg(\'Couldn\'t update the award\',\'error\');</script>';
			}
		} else if($_GET['lang']) {
			if($_GET['lang'] == 'TH') {
				$_SESSION['lang'] = 'TH';
			} else {
				$_SESSION['lang'] = 'EN';
			}
			echo '<meta http-equiv="refresh" content="0; url='.$_SERVER['HTTP_REFERER'].'" />';
		}
	?>
	
</body>
</html>