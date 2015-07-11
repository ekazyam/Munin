<?php
if (isset($_POST['munin_radio']))
{
	$target = str_replace('static_' , '' , $_POST['munin_radio'] );
	$command = 'tools/changetemplate.sh ' . $target;
	exec($command);
}
?>
