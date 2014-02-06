<?php 

session_start();

include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])){
?>

<html lang= "es"> 

<head>

<title>Blog 101</title>
<link rel="stylesheet" href="../assets/style.css"/>

</head>


<body>
<div class= "container">
<a href="index.php" id="logo">Blog 101</a>

<br/><br/>



<li><a href="add.php">Nuevo Articulo</a></li><br/>
<li><a href="delete.php">Eliminar un Articulo</a></li><br/>
<li><a href="logout.php">Cerrar Sesion</a></li><br/>




</div>
</body>

</html>

<?php

}else {

if(isset($_POST['username'], $_POST['password'])){
$username = $_POST['username'];
$password = md5($_POST['password']);

if(empty($username) or empty($password)){

	$error = 'Todos los campos son obligatorios';
} else{

   $query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND  user_password=?");
   $query->bindValue(1,$username);
    $query->bindValue(2,$password);

    $query->execute();

    $num = $query->rowCount();
   

   if($num == 1){
   	$_SESSION['logged_in']=true;
   	header('Location: index.php');
   	exit();

   } else {

   	$error ='El usuario o la contrasena son incorrectos';
   }
 }

}


?>

<html lang= "es"> 

<head>

<title>Blog 101</title>
<link rel="stylesheet" href="../assets/style.css"/>

</head>


<body>
<div class= "container">
<a href="index.php" id="logo">Blog 101</a>

<br/><br/>

<?php if(isset($error)){ ?>

<small style="color:#aa0000"><?php echo $error;?></small>
<br/><br/>
<?php } ?>

<form action="index.php" method="post" autocomplete="off">
<input type="text" name="username" placeholder="Nombre de usuario"/>
<input type="password" name="password" placeholder="Contrasena"/>
<input type="submit" value="Entrar"/>



</form>
</div>
</body>

</html>

<?php


}

?>