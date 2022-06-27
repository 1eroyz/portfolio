<?php
session_start();
require_once ("NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a' or $_SESSION['rights']=='s' or $_SESSION['rights']=='p' or $_SESSION['rights']=='o')
{
$id_a = $_SESSION['id'];
if ($_SESSION['rights']=='s') {
$queryss = "SELECT * FROM `student` where id_a = $id_a";
$select_group1 = mysqli_query($link, $queryss);
} else {
$queryss = "SELECT * FROM `student`";
$select_group1 = mysqli_query($link, $queryss);
}

$queryss3 = "SELECT * FROM `organization`";
$select_group11 = mysqli_query($link, $queryss3);

if ($_SESSION['rights']=='s') {
$queryss2 = "SELECT * FROM `student` where id_a = $id_a";
$select_group2 = mysqli_query($link, $queryss2);
} else {
$queryss2 = "SELECT * FROM `student` ";
$select_group2 = mysqli_query($link, $queryss2);
}

$queryss24 = "SELECT * FROM `organization`";
$select_group22 = mysqli_query($link, $queryss24);

if ($_SESSION['rights'] == 'o') {
	if(isset($_GET['searchtext'])) {
	
	$searchtext = $_GET['searchtext'];
	$select = $_GET['select'];
	//$_SESSION['page'] = $_SERVER['REQUEST_URI'];
	$query = "SELECT * FROM dogovor where id_org = (select id_org from organization where id_a = '$id_a') and $select LIKE '%$searchtext%'";
	$select_authors = mysqli_query($link, $query);
	} else {
		$query = "SELECT * FROM dogovor where id_org = (select id_org from organization where id_a = '$id_a')";
		$select_authors = mysqli_query($link, $query);
	}	
}else{
	if(isset($_GET['searchtext'])) {
	
	$searchtext = $_GET['searchtext'];
	$select = $_GET['select'];
	//$_SESSION['page'] = $_SERVER['REQUEST_URI'];
	$query = "SELECT * FROM dogovor where  $select LIKE '%$searchtext%'";
	$select_authors = mysqli_query($link, $query);
	} else {
		$query = "SELECT * FROM dogovor ";
		$select_authors = mysqli_query($link, $query);
	}	
}
	
/////////////////DELETE//////////////////////////
	if(isset($_GET['iduser'])) {
	$user_id = $_GET['iduser'];
	$query2 = "DELETE FROM dogovor WHERE id_d = $user_id";
	$res = mysqli_query($link, $query2);
	
	//if ($page == "") {
		//header( "refresh:0;url = registration.php" );
	//	header("Refresh: 1; url=$qwe");
	//}else{
	//$qwe = $_SESSION['page'];
	// header("Refresh: 1; url=$qwe");
	//}
	echo "";
	header( "refresh:0;url = dogovor.php" );
}

//order by id_st asc
//////////////////FORM_EDIT//////////////////
if(isset($_GET['iduser2'])) {
$iduser2 = $_GET['iduser2'];
$query4 = "SELECT * FROM dogovor WHERE id_d = $iduser2";
$result2 = mysqli_query($link, $query4);
$edit_user = mysqli_fetch_array($result2);
// header( "refresh:0;url = registration.php" );
// echo "";
}

//////////////////EDIT///////////////////////
if(isset($_GET['idst'])) {
$iduser3 = $_GET['idst'];
$id_st = $_GET['id_st'];
$id_org = $_GET['id_org'];
$date = $_GET['datee'];
if ($id_st != "" and $date !="") {
	$update_query = "UPDATE `dogovor` SET id_st = '$id_st', id_org = '$id_org', datee = '$date' WHERE id_d = $iduser3";
	$update_result = mysqli_query ($link, $update_query);
}

header( "refresh:0;url = dogovor.php" );
echo "";
}

?>
<html>
<head>
<meta name="robots" content="noindex, nofollow" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="styler_dogovor.css" >
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Договора</title>
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
		<?php if ($_SESSION['rights']=='p') { ?>
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
			<nav>Таблица "Договора"</nav><br>
			<nav class="add1">Изменение строки:</nav>
			<nav class="add2">Добавление строки:</nav><br>
			<!-- <a href="#" class="a1">Студент</a>
			<a href="#" class="a2">Преподователь</a>
			<a href="#" class="a3">Организация</a> -->
		</div>
		<div class="formreg">
				<form method="POST" class="ff2" action="forms/newdogovor.php">
					<select name="id_st_a" id="log" >
						<option selected value="">Выберите студента</option>
						<?php while ($groupp2 = mysqli_fetch_array($select_group1)){ ?>
					    <option  value = "<?php echo $groupp2['id_st'];?>"><?php echo $groupp2['id_st'];?> - <?php echo $groupp2['fio']; ?></option>
					    <?php } ?>  
				    </select><br>
				    <select name="id_org_a" id="log" >
				    	<?php if ($_SESSION['rights']=='o') {
				    		$queryo = "SELECT * FROM `organization`";
							$organize = mysqli_query($link, $queryo);
				    		while ($fgh = mysqli_fetch_array($organize)){ ?>
				    			<?php if ($fgh['id_a'] == $_SESSION['id']) { ?>
				    				<option selected value = "<?php echo $fgh['id_org'];?>"><?php echo $fgh['id_org'];?> - <?php echo $fgh['name']; ?></option>
				    			<?php } ?>
					   		 
				    		<?php } ?>
				    	<?php } else { ?> 
				    	<option selected value="">Выберите организацию</option>
						<?php while ($groupp22 = mysqli_fetch_array($select_group11)){ ?>
					    <option  value = "<?php echo $groupp22['id_org'];?>"><?php echo $groupp22['id_org'];?> - <?php echo $groupp22['name']; ?></option>
					    	<?php } ?>  
						<?php } ?> 
				    </select><br>
				    <input type="date"  name="datee_a" required size="20pt" maxlength="40" placeholder="Дата" id="log" class="k1" ><br>
					<input type="submit" value="Добавить договор">
				</form>

				<form method="get" class="ff4">
					<input type="text" style="display:none;" name="idst" value="<?php echo $edit_user['id_d'];?>">
					<select name="id_st" id="log" >

						<?php while ($groupp = mysqli_fetch_array($select_group2)){ ?>
					    <option <?php 
					    if ($groupp['id_st'] == $edit_user['id_st']) {
					    	echo 'selected';
					    }
					    ?> value = "<?php echo $groupp['id_st'];?>"><?php echo $groupp['id_st'];?> - <?php echo $groupp['fio']; ?></option>
					    <?php } ?>  
				    </select><br>
				    <select name="id_org" id="log" >
						<?php while ($grouppp = mysqli_fetch_array($select_group22)){ ?>
					    <option <?php 
					     
					    if ($grouppp['id_org'] == $edit_user['id_org']) {
					    	echo 'selected';
					    } else if ($_SESSION['rights']=='o') { echo "disabled";}
					    ?> value = "<?php echo $grouppp['id_org'];?>"><?php echo $grouppp['id_org'];?> - <?php echo $grouppp['name']; ?></option>
					    <?php } ?>  
				    </select><br>
				    <input type="date" name="datee" required size="20pt" maxlength="40" placeholder="Дата" id="log" class="k1" value="<?php echo $edit_user['datee']; ?>" ><br>
					<input type="submit" value="Редактировать договор">
				</form>
		</div>
		
		<div class="table">
			<div class="search" style="float: right; width: 100%">
				<form method="get">
					<select name="select" >
					    <option selected value="id_d">Id</option>
					    <option value="id_st">Студент</option>
					    <option value="id_org">Организация</option>
					    <option value="datee">Дата</option>
				    </select>
					<input name="searchtext" type="text" placeholder="Введите запрос" id="searcht" style="width:61%;">
					<input type="submit" id="searchb" value="Поиск">
				</form>
			</div>
			<table style="float: right; width: 100%;">
				<thead>
					<tr>
						<td width="50">Id</td>
						<td>Студент</td>
						<td>Организация</td>
						<td width=" 150">Дата</td>
					</tr>
				</thead>
				<tbody>
					<?php while ($account = mysqli_fetch_array($select_authors)){ ?>
					<tr>
						<td>	
							<?php echo $account['id_d']; ?>	
						</td>
						<td>

							<?php 
							$search_id = $account['id_st'] ;
							$studentid = "SELECT * FROM student WHERE id_st = $search_id";
							$resultstudent = mysqli_query($link, $studentid);
							$accountstudent = mysqli_fetch_array($resultstudent);
							echo $accountstudent['fio']; 
							?>
						</td>
						<td>
							<?php 
							$search_id2 = $account['id_org'] ;
							$studentid2 = "SELECT * FROM organization WHERE id_org = $search_id2";
							$resultstudent2 = mysqli_query($link, $studentid2);
							$accountstudent2 = mysqli_fetch_array($resultstudent2);
							echo $accountstudent2['name']; 
							?>
						</td>
						<td>
							<?php echo $account['datee']; ?>
							<!-- <a href="edituser.php?iduser=<?php echo $authors['id']; ?>">
							Изменить</a>
							<a href="deleteuser.php?iduser=<?php echo $authors['id']; ?>">
							Удалить</a> -->
							<!-- <a href="forms/deleteuser.php?iduser=<?php echo $account['id']; ?>"><img src="img/delete.svg" class="q1"></a> -->
							<?php 

							if ($_SESSION['rights']=='s' and $_SESSION['id'] == $accountstudent['id_a']) { ?>
							<a href="?iduser=<?php echo $account['id_d']; ?>"><img src="img/delete.svg" class="q1"></a>
							<a href="?iduser2=<?php echo $account['id_d']; ?>" ><img src="img/edit.svg" class="q2"></a>
							<?php } else if ($_SESSION['rights']!='s') { ?>
							<a href="?iduser=<?php echo $account['id_d']; ?>"><img src="img/delete.svg" class="q1"></a>
							<a href="?iduser2=<?php echo $account['id_d']; ?>" ><img src="img/edit.svg" class="q2"></a>
							<?php } ?>
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
