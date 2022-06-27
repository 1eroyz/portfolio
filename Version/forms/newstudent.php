<?php
session_start();
require_once ("../NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a' or $_SESSION['rights']=='p')
{
	echo "";
	$fio = $_POST['fio_a'];
	$id_gr = $_POST['id_gr_a'];
	$adress = $_POST['adress_a'];
	$srball = $_POST['srball_a'];
	if(($fio)&&($id_gr)&&($adress)&&($srball))
	{
	$query = "INSERT INTO student VALUES (NULL ,'$fio', '$id_gr', '$adress', '$srball')";
	mysqli_query($link, $query);
	header( "refresh:0;url = ../student.php" );
	echo "";
	}
}
else
{
header( "refresh:2;url = ../index.php" );
echo "Извините, у Вас нет доступа";
}
?>


