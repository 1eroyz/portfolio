<?php
session_start();
if ($_SESSION['rights']=='a')
{
echo "hello, ".$_SESSION['login'];
$user_id = $_GET['iduser'];
require_once ("PajmanDB.php");
$query = "SELECT * FROM authors WHERE id = $user_id";
$result = mysqli_query ($link, $query);
$edit_user = mysqli_fetch_array ($result);
?>

<html>
<head>
<meta charset="utf-8">
</head>
<body>
<form method="post">
<p>Логин: <input type="text" name="login"
value = "<?php echo $edit_user['login'];?>" /></p>

<p>Пароль: <input type="text" name="password"
value = "<?php echo $edit_user['password'];?>" /></p>

<p>Права: <input type="text" name="rights"
value = "<?php echo $edit_user['rights'];?>" /></p>


<input type="submit" name="submit" value="Изменить" />
</form>
<a href = "accounts.php"> Назад </a>
</body>
</html>
<?php
$login = $_POST['login'];
$password = $_POST['password'];
$rights = $_POST['rights'];
$update_query = "UPDATE authors SET login = '$login', password = '$password', rights = '$rights'
WHERE id = $user_id";
$update_result = mysqli_query ($link, $update_query);
}
else
{
echo "Извините, у Вас нет доступа";
echo "<a href = \"index.php\">На главную</a>";
}
?>