<?php
require_once("NikiforovDB.php");
$login = $_POST['login'];
$password = $_POST['password'];
//echo $login, $password, "<br>";
if(($login) &&($password))
{
$query = "SELECT * FROM account WHERE login = '$login' AND password = '$password'";
$send_query = mysqli_query($link, $query);
$user_array = mysqli_fetch_array($send_query);
$login = $user_array['login'];
$rights = $user_array['rights'];
$id = $user_array['id'];
$count = mysqli_num_rows($send_query);
if ($count >0)
{
session_start();
$_SESSION['id'] = $id;
$_SESSION['login'] = $login;
$_SESSION['rights'] = $rights;
header( "refresh:0;url = index.php" );
echo '';
}
else
{
header( "refresh:0;url = login.php" );
echo "";
}
}
?>