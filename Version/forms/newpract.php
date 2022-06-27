<?php
session_start();
require_once ("../NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a')
{
	echo "";
$name = $_POST['name_a'];
$spec = $_POST['spec_a'];
$kolvo = $_POST['kolvo_a'];
	if(($name)&&($spec)&&($kolvo))
	{
	$query = "INSERT INTO pract VALUES (NULL ,'$name', '$spec', '$kolvo')";
	mysqli_query($link, $query);
	header( "refresh:0;url = ../pract.php" );
	echo "";
	}
	else {
	header( "refresh:1;url = ../pract.php" );
	echo "";
	}
}
else
{
header( "refresh:2;url = ../index.php" );
echo "Извините, у Вас нет доступа";
}
?>


