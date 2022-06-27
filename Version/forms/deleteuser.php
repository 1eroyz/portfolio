<?php
session_start();
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a')
{
require_once("../NikiforovDB.php");
$user_id = $_GET['iduser'];
// mysqli_select_db($link, $db);

$query2 = "DELETE FROM organization WHERE id_a = $user_id";
$res = mysqli_query($link, $query2);
$query3 = "DELETE FROM prepod WHERE id_a = $user_id";
$res2 = mysqli_query($link, $query3);
$query = "DELETE FROM account WHERE id = $user_id";
$res3 = mysqli_query($link, $query);
header( "refresh:0;url = ../registration.php" );
echo "";
}
else
{
header( "refresh:1;url = ../index.php" );
echo "Извините, у Вас нет доступа";
}
?>
