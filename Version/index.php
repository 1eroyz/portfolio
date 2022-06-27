<?php
session_start();
require_once ("NikiforovDB.php");
?>
<html>
<head>
<meta name="robots" content="noindex, nofollow" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" >
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Практика</title>

<style type="text/css">

  </style>
</head>
<body>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script>
		$(document).ready(function(){
			$(function (){
				$("#back-top a").click(function (){
					$("body,html").animate({
						scrollTop:1200
					}, 900);
					return false;
				});
			});
		});
		</script>
   <script>
        $(document).ready(function(){       
		    var scroll_pos = 0;
		    		$(".nav2 #22").removeClass("changeColorblue");
		        	$(".nav2 #22").addClass("changeColorblack");
		        	$(".nav2 #11").removeClass("changeColorblack");
		            $(".nav2 #11").addClass("changeColorblue");
		    $(document).scroll(function() { 
		        scroll_pos = $(this).scrollTop();
		        if(scroll_pos > 800) {
		        	$(".nav2 #11").removeClass("changeColorblue");
		        	$(".nav2 #11").addClass("changeColorblack");
		        	$(".nav2 #22").removeClass("changeColorblack");
		            $(".nav2 #22").addClass("changeColorblue");
		            
		        } 
		        else {
		            $(".nav2 #22").removeClass("changeColorblue");
		        	$(".nav2 #22").addClass("changeColorblack");
		        	$(".nav2 #11").removeClass("changeColorblack");
		            $(".nav2 #11").addClass("changeColorblue");
		        } 
		    });
		    
		});
    </script>
    <script type="text/javascript">
		$(document).ready(function(){
		$('#menunav').click(function(){
		$(this).parent().children('#menunav2').slideToggle({duration:250, easing:"linear"});
		$('#str').toggleClass('flip');
		return false;
		});
		});
	</script>
	<div class="content1">
		<div id="1"></div>
		<div class="nav1" id="menu">
			<div class="logo">
				<div class="square"></div>
				<div class="text-logo">
					Сайт-база данных
				</div>
			</div>
			<div class="nav2">
				<ul>
					<li><a href="#1" id="11">Главная</a></li>
					<li><a href="#2" id="22">Таблицы</a></li>
				</ul>
			</div>
			<?php
			if ($_SESSION['rights']=='a' or $_SESSION['rights']=='s' or $_SESSION['rights']=='o' or $_SESSION['rights']=='p' or $_SESSION['rights']=='gl_a')
			{
			?>
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
						</div>
						<div class="menulog">
							<img src="path.png" width="100%" id="str">
						</div>
				</div> 
			</nav> 
				<?php
				}
				else
				{ ?>
				<div class="nav4"><a href="login.php">Войти</a></div>
				<?php
				}
				?>

				<!-- <div class="nav3"><a href="registration.html">Регистрация</a></div> -->
			
			 
			<div id="menunav2">
				<ul>
					<li id="profile"><a href="index.php#2">Таблицы</a></li>
					<li id="amxmenu" ><a href="registration.php">Панель администратора</a></li>
					<li id="out"><a href="logout.php">Выход</a></li>
				</ul>
			</div>
		</div>
		<div class="logomain">
			<img src="logomain.svg">
		</div>
		<div class="title">
			Сайт-база данных по производственной практике
		</div>
		<div class="button1" id="back-top">
			<a href="">Смотреть таблицы<img src="strelka.svg"></a>
		</div>
	</div>
	<div id="content1">
		
		<!-- <br><br><br><br><br>
		<a href="student.php">student</a><br>
		<a href="report.php">report</a><br>
		<a href="prepod.php">prepod</a><br>
		<a href="pract.php">pract</a><br>
		<a href="organization.php">organization</a><br>
		<a href="group.php">group</a><br>
		<a href="dogovor.php">dogovor</a><br>
		<a href="appointment.php">appointment</a><br> -->
		
		<div class="tables">
			<?php if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a' or $_SESSION['rights']=='s' or $_SESSION['rights']=='o' or $_SESSION['rights']=='p')
			{ ?>
			<ul>
				<li class="top" class="n1">
					<div class="item"> 
						<a href="student.php"><img src="img/table.svg"></a>
						<p>Таблица "Студенты"</p>
						<a href="student.php" class="a">Посмотреть</a>
					</div>
				</li>
				<li class="top" id="n2">
					<div class="item"> 
						<a href="report.php"><img src="img/table.svg"></a>
						<p>Таблица "Отчёты"</p>
						<a href="report.php" class="a">Посмотреть</a>
					</div>
				</li>
				<li class="top" id="n3">
					<div class="item"> 
						<a href="dogovor.php"><img src="img/table.svg"></a>
						<p>Таблица "Договора"</p>
						<a href="dogovor.php" class="a">Посмотреть</a>
					</div>
				</li>
				<li class="top" id="n4">
					<div class="item"> 
						<a href="pract.php"><img src="img/table.svg"></a>
						<p>Таблица "Практики"</p>
						<a href="pract.php" class="a">Посмотреть</a>
					</div>
				</li>
				<li id="n5">
					<div class="item"> 
						<a href="organization.php"><img src="img/table.svg"></a>
						<p>Таблица "Организации"</p>
						<a href="organization.php" class="a">Посмотреть</a>
					</div>
				</li>
				<?php if ($_SESSION['rights']!='o') { ?>
		    	<li id="n6">
					<div class="item"> 
						<a href="prepod.php"><img src="img/table.svg"></a>
						<p>Таблица "Преподователи"</p>
						<a href="prepod.php" class="a">Посмотреть</a>
					</div>
				</li>
		    	<?php } ?>
		    	<?php if ($_SESSION['rights']!='o') { ?>
				<li id="n7">
					<div class="item"> 
						<a href="appointment.php"><img src="img/table.svg"></a>
						<p>Таблица "Назначение"</p>
						<a href="appointment.php" class="a">Посмотреть</a>
					</div>
				</li>
				<?php } ?>
				<?php if ($_SESSION['rights']!='o') { ?>
				<li id="n8">
					<div class="item"> 
						<a href="group.php"><img src="img/table.svg"></a>
						<p>Таблица "Группы"</p>
						<a href="group.php" class="a">Посмотреть</a>
					</div>
				</li>
				<?php } ?>
			</ul>
			<?php } else { ?>
				<div class="message">
					Вам недоступны таблицы, чтобы посмотреть их, необходимо войти в аккаунт<br>
					<a href="login.php">Войти в аккаунт</a>
				</div>
			<?php } ?>
		</div>
		<div id="2"></div>
	</div>
</body>
</html>
