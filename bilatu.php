<html>
<head>
	<link rel="stylesheet" href="bilatu.css"/>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#izena').click(function(){
				$('bilatu.php',{'#izena':$(this).text()},function(data){
					$('#sagartotegia').load (sagardotegia.php);
				});
				return false;
			});
		}) ;
	</script>
</head>
<body>
<?php
	$herria=$_POST["herria"];
?>
<div id="menu_txikia">
	<form action="index.html" method="post">
		<input id="bilatu" type="submit" name="herria" value="Bilatzailea">
	</form>
</div>
	<div id="header">
		<img id="logo" src="img/logo.png"/>
		<h1><?php echo $herria ?></h1>
	</div>

<?php
	$con=mysql_connect("localhost", "root", "zubiri");

	if(!$con){
		echo "Conexion fallida";
		exit;
	}

	if(!mysql_select_db("txotx", $con)){
		echo "Error seleccion base de datos";
		exit;
	}
	$sql="SELECT idherriak FROM herriak WHERE izena='".$herria."';";
	$result=mysql_query($sql, $con);

	if(!$result){
		echo "Error resultado";
		exit;
	}

	$idherria=mysql_fetch_array($result);
	$id=$idherria['idherriak'];

	$sql="SELECT izena FROM sagardotegiak WHERE herria='".$id."';";
	$result=mysql_query($sql, $con);

	
	while($row=mysql_fetch_array($result)){
?>
		<div id="izena">
			<?php
				$izena=$row['izena'];
			?>
			<form action="sagardotegia.php" method="post">
				<input type="hidden" name="herria" value="<?php echo $herria ?>">
				<input id="sagar_ize" type="submit" name="izena" 
				value="<?php echo $izena ?>">
			</form>
		</div>
<?php
	}	
?>	
</body>
</html>