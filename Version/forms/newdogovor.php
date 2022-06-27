<?php
session_start();
require_once ("../NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a' or $_SESSION['rights']=='s' or $_SESSION['rights']=='o')
{
	echo "";
	$id_st = $_POST['id_st_a'];
	$id_org = $_POST['id_org_a'];
	$date = $_POST['datee_a'];
	if(($id_st)&&($id_org)&&($date))
	{
	$query = "INSERT INTO dogovor VALUES (NULL ,'$id_st', '$id_org', '$date')";
	mysqli_query($link, $query);
	header( "refresh:0;url = ../dogovor.php" );
	echo "";
	}
}
else
{
header( "refresh:2;url = ../index.php" );
echo "Извините, у Вас нет доступа";
}
?>


