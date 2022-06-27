<?php
session_start();
require_once ("NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a'  or $_SESSION['rights']=='s' or $_SESSION['rights']=='p')
{

$queryss = "SELECT * FROM `pract`";
$select_group1 = mysqli_query($link, $queryss);

$queryss3 = "SELECT * FROM `group`";
$select_group11 = mysqli_query($link, $queryss3);

$queryss33 = "SELECT * FROM `prepod`";
$select_group111 = mysqli_query($link, $queryss33);

$queryss2 = "SELECT * FROM `pract`";
$select_group2 = mysqli_query($link, $queryss2);

$queryss22 = "SELECT * FROM `group`";
$select_group22 = mysqli_query($link, $queryss22);


$queryss24 = "SELECT * FROM `prepod`";
$select_group222 = mysqli_query($link, $queryss24);

if(isset($_GET['searchtext'])) {
	
	$searchtext = $_GET['searchtext'];
	$select = $_GET['select'];
	//$_SESSION['page'] = $_SERVER['REQUEST_URI'];
	$query = "SELECT * FROM appointment
	WHERE $select LIKE '%$searchtext%'";
	$select_authors = mysqli_query($link, $query);
} else {
	$query = "SELECT * FROM appointment";
	$select_authors = mysqli_query($link, $query);
}		
/////////////////DELETE//////////////////////////
	if(isset($_GET['iduser'])) {
	$user_id = $_GET['iduser'];
	$query2 = "DELETE FROM appointment WHERE id = $user_id";
	$res = mysqli_query($link, $query2);
	
	//if ($page == "") {
		//header( "refresh:0;url = registration.php" );
	//	header("Refresh: 1; url=$qwe");
	//}else{
	//$qwe = $_SESSION['page'];
	// header("Refresh: 1; url=$qwe");
	//}
	echo "";
	header( "refresh:0;url = appointment.php" );
}

//order by id_st asc
//////////////////FORM_EDIT//////////////////
if(isset($_GET['iduser2'])) {
$iduser2 = $_GET['iduser2'];
$query4 = "SELECT * FROM appointment WHERE `id` = $iduser2";
$result2 = mysqli_query($link, $query4);
$edit_user = mysqli_fetch_array($result2);
// header( "refresh:0;url = registration.php" );
// echo "";
}

//////////////////EDIT///////////////////////
if(isset($_GET['idst'])) {
$iduser3 = $_GET['idst'];
$id_pr = $_GET['id_pr'];
$id_gr = $_GET['id_gr'];
$id_r = $_GET['id_r'];
if ($id_pr != "" and $id_gr !="" and $id_r !="") {
	$update_query = "UPDATE `appointment` SET id_pr = '$id_pr', id_gr = '$id_gr', id_r = '$id_r' WHERE `id` = $iduser3";
	$update_result = mysqli_query ($link, $update_query);
}

header( "refresh:0;url = appointment.php" );
echo "";
}

?>
<html>
<head>
<meta name="robots" content="noindex, nofollow" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="styler_appointment.css" >
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Назначения</title>
<style type="text/css">
.table .q1
{
  margin: 0 0 0 15;
  float: right;
  width: 1.2em;
}
.table .q2
{
  float: right;
  width: 1.2em;
}
.floatl{
  margin-left: -250; 
}
.floatr{
  margin-left: 240; 
}

</style>
</head>
<body>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	 <script type="text/javascript">
		$(document).ready(function(){
		$('#menunav').click(function(){
		$(this).parent().children('#menunav2').slideToggle({duration:250, easing:"linear"});
		$('#str').toggleClass('flip');
		return false;
		});
		});
	</script>
	<script type="text/javascript">
		$(function(){
		<?php if(isset($_GET['iduser2'])) { ?>
                $('.ff2').addClass('display');
                $('.ff4').removeClass('display');
                $('.add1').removeClass('display');
				$('.add2').addClass('display');
                
		<?php }else{ ?>
				$('.ff2').removeClass('display');
                $('.ff4').addClass('display');
            	$('.add1').addClass('display');
				$('.add2').removeClass('display');

            
		<?php } ?>	
		<?php if ($_SESSION['rights']=='s' or $_SESSION['rights']=='p') { ?>
				$('.formreg').addClass('display');
				$('.table').addClass('floatl');
				$('.buttons').addClass('floatr');
				$('.q1').addClass('display');
				$('.q2').addClass('display');
				$('.add1').addClass('display');
				$('.add2').addClass('display');
		<?php } ?>
		});
	</script>
	<div class="content1">
		<div class="nav1" id="menu">
			<div class="logo">
				<div class="square"></div>
				<a href="index.php" style="color:black;">
					<div class="text-logo">
						Сайт-база данных
					</div>
				</a>
			</div>
				<!-- <div class="nav3"><a href="login.html">Войти</a></div> -->
				<!-- <div class="nav4"><a href="index.php">Главная</a></div> -->
				<nav id="menunav">
				<div class="loginon" >
						<div class="circle">
							<?php if ($_SESSION['rights'] =='a') { ?>
							<img src="img/adm.png" width="100%" align="100%">
							<?php } else if ($_SESSION['rights'] =='gl_a') { ?>
							<img src="img/admin.png" width="100%" align="100%">
							<?php } else if ($_SESSION['rights'] =='o') { ?>
								<img src="img/or.png" width="100%" align="100%">
							<?php } else if ($_SESSION['rights'] =='s') { ?>
								<img src="img/st.png" width="100%" align="100%">
							<?php } else if ($_SESSION['rights'] =='p') { ?>
								<img src="img/pr.png" width="100%" align="100%">
							<?php } ?>
						</div>
						<div class="namelog">
							<?php echo $_SESSION['login']; ?>
							<!-- Администратор -->
						</div>
						<div class="menulog">
							<img src="path.png" width="100%" id="str">
						</div>
				</div>
			</nav> 
			<div id="menunav2">
				<ul>
					<li id="profile"><a href="index.php#2">Таблицы</a></li>
					<li id="amxmenu"><a href="registration.php">Панель администратора</a></li>
					<li id="out"><a href="logout.php">Выход</a></li>
				</ul>
			</div>
		</div>
		<div class="buttons">
			<nav>Таблица "Назначения"</nav><br>
			<nav class="add1">Изменение строки:</nav>
			<nav class="add2">Добавление строки:</nav><br>
			<!-- <a href="#" class="a1">Студент</a>
			<a href="#" class="a2">Преподователь</a>
			<a href="#" class="a3">Организация</a> -->
		</div>
		<div class="formreg">
				<form method="POST" class="ff2" action="forms/newappointment.php">
					<select name="id_pr_a" id="log" >
						<option selected value="">Выберите практику</option>
						<?php while ($groupp2 = mysqli_fetch_array($select_group1)){ ?>
					    <option  value = "<?php echo $groupp2['id_pr'];?>"><?php echo $groupp2['id_pr'];?> - <?php echo $groupp2['name']; ?></option>
					    <?php } ?>  
				    </select><br>
				    <select name="id_gr_a" id="log" >
				    	<option selected value="">Выберите группу</option>
						<?php while ($groupp22 = mysqli_fetch_array($select_group11)){ ?>
					    <option  value = "<?php echo $groupp22['id_gr'];?>"><?php echo $groupp22['id_gr'];?> - <?php echo $groupp22['gr']; ?></option>
					    <?php } ?>  
				    </select><br>
				    <select name="id_r_a" id="log" >
				    	<option selected value="">Выберите преподователя</option>
						<?php while ($groupp222 = mysqli_fetch_array($select_group111)){ ?>
					    <option  value = "<?php echo $groupp222['id_r'];?>"><?php echo $groupp222['id_r'];?> - <?php echo $groupp222['fio']; ?></option>
					    <?php } ?>  
				    </select><br>
					<input type="submit" value="Добавить назначение">
				</form>

				<form method="get" class="ff4">
					<input type="text" style="display:none;" name="idst" value="<?php echo $edit_user['id'];?>">
					<select name="id_pr" id="log" >
						<?php while ($groupp = mysqli_fetch_array($select_group2)){ ?>
					    <option <?php 
					    if ($groupp['id_pr'] == $edit_user['id_pr']) {
					    	echo 'selected';
					    }
					    ?> value = "<?php echo $groupp['id_pr'];?>"><?php echo $groupp['id_pr'];?> - <?php echo $groupp['name']; ?></option>
					    <?php } ?>  
				    </select><br>
				    <select name="id_gr" id="log" >
						<?php while ($grouppp = mysqli_fetch_array($select_group22)){ ?>
					    <option <?php 
					    if ($grouppp['id_gr'] == $edit_user['id_gr']) {
					    	echo 'selected';
					    }
					    ?> value = "<?php echo $grouppp['id_gr'];?>"><?php echo $grouppp['id_gr'];?> - <?php echo $grouppp['gr']; ?></option>
					    <?php } ?>  
				    </select><br>
				    <select name="id_r" id="log" >
						<?php while ($group = mysqli_fetch_array($select_group222)){ ?>
					    <option <?php 
					    if ($group['id_r'] == $edit_user['id_r']) {
					    	echo 'selected';
					    }
					    ?> value = "<?php echo $group['id_r'];?>"><?php echo $group['id_r'];?> - <?php echo $group['fio']; ?></option>
					    <?php } ?>  
				    </select><br>
					<input type="submit" value="Редактировать назначение">
				</form>
		</div>
		
		<div class="table">
			<div class="search" style="float: right; width: 100%">
				<form method="get">
					<select name="select" >
					    <option selected value="id">Id</option>
					    <option value="id_pr">Практика</option>
					    <option value="id_gr">Группа</option>
					    <option value="id_r">Преподователь</option>

				    </select>
					<input name="searchtext" type="text" placeholder="Введите запрос" id="searcht" style="width:59%;">
					<input type="submit" id="searchb" value="Поиск">
				</form>
			</div>
			<table style="float: right; width: 100%;" >
				<thead>
					<tr>
						<td>Id</td>
						<td>Практика</td>
						<td width="100">Группа</td>
						<td width=" 150">Преподователь</td>
					</tr>
				</thead>
				<tbody>
					<?php while ($account = mysqli_fetch_array($select_authors)){ ?>
					<tr>
						<td valign="top">	
							<?php echo $account['id']; ?>	
						</td>
						<td valign="top">
							<?php 
							$search_id = $account['id_pr'] ;
							$studentid = "SELECT * FROM pract WHERE id_pr = $search_id";
							$resultstudent = mysqli_query($link, $studentid);
							$accountstudent = mysqli_fetch_array($resultstudent);
							echo $accountstudent['name']; 
							?>
						</td>
						<td valign="top">
							<?php 
							$search_id2 = $account['id_gr'] ;
							$studentid2 = "SELECT gr FROM `group` WHERE id_gr = $search_id2";
							$resultstudent2 = mysqli_query($link, $studentid2);
							$accountstudent2 = mysqli_fetch_array($resultstudent2);
							echo $accountstudent2['gr']; 
							?>
						</td >
						<td valign="top">
							<?php 
							$search_id3 = $account['id_r'] ;
							$studentid3 = "SELECT * FROM prepod WHERE id_r = $search_id3";
							$resultstudent3 = mysqli_query($link, $studentid3);
							$accountstudent3 = mysqli_fetch_array($resultstudent3);
							echo $accountstudent3['fio']; 
							?>
							<!-- <a href="edituser.php?iduser=<?php echo $authors['id']; ?>">
							Изменить</a>
							<a href="deleteuser.php?iduser=<?php echo $authors['id']; ?>">
							Удалить</a> -->
							<!-- <a href="forms/deleteuser.php?iduser=<?php echo $account['id']; ?>"><img src="img/delete.svg" class="q1"></a> -->
							<div style="float: right;">
							<a href="?iduser=<?php echo $account['id']; ?>"><img src="img/delete.svg" class="q1"></a>
							<!-- <a href=""><img src="img/edit.svg" class="q2"></a> -->
							<a href="?iduser2=<?php echo $account['id']; ?>" ><img src="img/edit.svg" class="q2"></a>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
<?php 
}
else
{
	header( "refresh:1;url = index.php" );
	echo 'Доступ воспрещен!';	
}




?>
