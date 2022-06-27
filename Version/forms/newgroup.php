<?php
session_start();
require_once ("../NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a')
{
	echo "";
	$gr = $_POST['gr_a'];
	if($gr)
	{
	$query = "INSERT INTO `group` VALUES (NULL ,'$gr')";
	mysqli_query($link, $query);
	header( "refresh:0;url = ../group.php" );
	echo "";
	}
}
else
{
header( "refresh:2;url = ../index.php" );
echo "Извините, у Вас нет доступа";
}
?>


