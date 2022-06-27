<?php
session_start();
require_once ("../NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a')
{
	echo "";
	$login = $_POST['login_s'];
	$password = $_POST['password_s'];
	$rights = 's';
	$fio = $_POST['fio_a'];
	$id_gr = $_POST['id_gr_a'];
	$adress = $_POST['adress_a'];
	$srball = $_POST['srball_a'];
	if(($login)&&($password)&&($rights))
	{
	$query = "INSERT INTO account VALUES (NULL ,'$login', '$password', '$rights')";
	mysqli_query($link, $query);
	$query_search_m = "SELECT * FROM account ORDER BY id DESC LIMIT 1";
	$select_search_m = mysqli_query($link, $query_search_m);
	$search_m = mysqli_fetch_array($select_search_m);
	$search_end = $search_m['id'];
	$query2 = "INSERT INTO student VALUES (NULL ,'$fio', '$id_gr', '$adress', '$srball', '$search_end')";
	mysqli_query($link, $query2);
	header( "refresh:0;url = ../registration.php" );
	echo "";
	}
}
else
{
header( "refresh:1;url = ../index.php" );
echo "Извините, у Вас нет доступа";
}
?>


