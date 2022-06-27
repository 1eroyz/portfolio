<?php
session_start();
require_once ("../NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a')
{
	echo "";
	$id_pr = $_POST['id_pr_a'];
	$id_gr = $_POST['id_gr_a'];
	$id_r = $_POST['id_r_a'];
	if(($id_pr)&&($id_gr)&&($id_r))
	{
	$query = "INSERT INTO appointment VALUES (NULL ,'$id_pr', '$id_gr', '$id_r')";
	mysqli_query($link, $query);
	header( "refresh:0;url = ../appointment.php" );
	echo "";
	} else {
		header( "refresh:1;url = ../appointment.php" );
	echo "Введите все данные";
	}
}
else
{
header( "refresh:2;url = ../index.php" );
echo "Извините, у Вас нет доступа";
}
?>


