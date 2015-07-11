<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="js/alert/themes/alertify.core.css">
	<link rel="stylesheet" href="js/alert/themes/alertify.default.css">
	
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script
	<script type="text/javascript" src="js/alertify.js"></script>
	<script type="text/javascript" src="js/munin_change.js"></script>
	<script src="js/alert/lib/alertify.js"></script>
</head>
<body>
	<form name="form" method="POST" action="">
<?php 
	include_once('backend/create_table.php');
	include_once('backend/cmd_exe.php');
	create_table();
?>
	</form>
	<div class="change_submit">
	<input type="submit" id="change" value="submit">
	</div>
</body>
</html>
