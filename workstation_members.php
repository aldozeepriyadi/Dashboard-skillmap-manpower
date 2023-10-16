<?php include("includes/db_connection.php"); ?>
<?php include("includes/a_config.php");?>
<?php include("includes/redirect_session.php");?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
</head>
<body>

<?php include("includes/design-top.php");?>

<?php
    $ws_id = $_REQUEST['q'];

    $q_res = $conn->query("SELECT name FROM workstations WHERE id = ".$ws_id);
	$num_results = $q_res->num_rows;
    $current_ws = $q_res->fetch_assoc();
?>

<?php 
if ($num_results > 0)
	include("includes/content/ws-page.php");
else include("includes/content/not-found-page.php");
?>

</body>
</html>
