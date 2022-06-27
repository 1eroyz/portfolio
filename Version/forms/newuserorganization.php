<?php
session_start();
require_once ("../NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a')
{
	echo "";
	$login = $_POST['login_o'];
	$password = $_POST['password_o'];
	$name = $_POST['name_o'];
	$adress = $_POST['adress_o'];
	$number = $_POST['number_o'];
	$rights = 'o';
	if(($login)&&($password)&&($rights))
	{
	$query = "INSERT INTO account VALUES (NULL ,'$login', '$password', '$rights')";
	mysqli_query($link, $query);
	// $query3 = "select Max(id) as last_id from account";
	// $select = mysqli_query($link, $query3);
	// $id_ac = mysqli_fetch_array($select);
	$query_search_m = "SELECT * FROM account ORDER BY id DESC LIMIT 1";
	$select_search_m = mysqli_query($link, $query_search_m);
	$search_m = mysqli_fetch_array($select_search_m);
	$search_end = $search_m['id'];
	$query2 = "INSERT INTO organization VALUES (NULL ,'$name', '$adress','$number', '$search_end')";
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

