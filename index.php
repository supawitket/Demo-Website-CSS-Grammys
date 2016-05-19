<?
	session_start();

	if(empty($_SESSION['lang']))
		$_SESSION['lang'] = 'EN';

	require('assets/lang.inc.php');


?>
<html>
<head>
	<title>Grammys winners and nominees management</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	<script type="text/javascript" src="script.js"></script>
</head>
<body>

	
	<div class="top_menu">
		<div class="wrapper">
			<div class="toolbar lang wrapper" style="margin-top:0px">
				<a href="popup.php?lang=TH" <? if($_SESSION['lang'] == 'TH') echo 'class="active"'; ?> >TH</a> / 
				<a href="popup.php?lang=EN" <? if($_SESSION['lang'] == 'EN') echo 'class="active"'; ?> >EN</a>
			</div>

			<li><a href="index.php" <? if(!$_GET) echo 'class="active"'; ?> ><? echo $lang[$_SESSION['lang']]['home']; ?></a></li>
			<li><a href="?a=new" <? if($_GET[a]=='new') echo 'class="active"'; ?> ><? echo $lang[$_SESSION['lang']]['new']; ?></a></li>
			<? if($_GET['edit']) echo '<li><a href="?edit='.$_GET[edit].'" class="active">'.$lang[$_SESSION['lang']]['edit'].'</a></li>'; ?>
			
		</div>
	</div>

	<div class="main_box wrapper">
		<?

			require("assets/sql.inc.php");

			if($_GET) {
				require_once('assets/main.inc.php');
			} else {
				require_once('assets/home.inc.php');
			}
		?>
	</div>

	<div class="footer">
		<div class="wrapper">
			<div class="toolbar wrapper">
				<a href="#">TOP</a>
			</div>
			54th Grammys winners and nominees management. All rights reserved.
		</div>
	</div>

	<div class="modal_window" id="modal_window" style="display:none">
		<div class="wrapper box">
			<div class="toolbar wrapper">
				<a href="javascript:void(0);" onclick="toggle('modal_window');" class="btRed"><? echo $lang[$_SESSION['lang']]['close']; ?></a>
			</div>
			<iframe id="modal_frame" src="44.php" frameborder="0"></iframe>
		</div>
	</div>

</body>
</html>