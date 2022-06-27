<?php
session_start();
require_once ("../NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a' or $_SESSION['rights']=='p' )
{
	echo "";
	$id_st = $_POST['id_st_a'];
	$id_pr = $_POST['id_pr_a'];
	$id_org = $_POST['id_org_a'];
	$otziv = $_POST['otziv_a'];
	$ocenka = $_POST['ocenka_a'];
	if(($otziv)&&($ocenka))
	{
	$query = "INSERT INTO report VALUES (NULL ,'$id_st', '$id_pr', '$id_org', '$otziv', '$ocenka')";
	mysqli_query($link, $query);
	header( "refresh:0;url = ../report.php" );
	echo "";
	}
	else {
		header( "refresh:1;url = ../report.php" );
		echo "";
	}
}
else
{
header( "refresh:2;url = ../index.php" );
echo "Извините, у Вас нет доступа";
}
?>


