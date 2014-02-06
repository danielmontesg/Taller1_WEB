<?php

session_start();
include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])){


if(isset($_POST['title'],$_POST['content'])){
	$title= $_POST['title'];
	$content=nl2br($_POST['content']);

	if(empty($title) or empty($content)){
		$error='All fields are required.';
	} else {
		$query = $pdo->prepare('INSERT INTO articles(article_title, article_content, article_timestamp) VALUES (?,?,?)');
		$query->bindValue(1,$title);
		$query->bindValue(2, $content);
		$query->bindValue(3, time());
		$query->execute();
		header('Location:index.php');
	}
}
?>
<html>
	<head>
		<title>CMS tutorial</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo">Blog 101</a>
				<br />
				<h5> Nuevo Articulo </h5>

				<?php if(isset($error)){ ?>

<small style="color:#aa0000"><?php echo $error;?></small>

<?php } ?>

				<form action="add.php" method="post" autocomplete="off ">
					<input type="text" name="title" placeholder="Titulo"/><br /><br />
					<textarea rows="15" cols="50" placeholder="Escribe aqui tu post..." name="Content"></textarea><br/>
					<input type="submit" value="Publicar"/><br/><br/>
					<a href="index.php">&larr; Back </a>

				</form>
		</div>
	</body>
</html>
<?php
}else {
	header('Location:index.php');
}
?>