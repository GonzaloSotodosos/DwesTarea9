<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Utilizar servicio Web</title>
	</head>
	<body>		
		<section>
		<?php
        /*Llamar a la api https://randomuser.me/api/?results=50 que contiene datos de 50 personas,
		devuelve por defecto los datos en JSON. Guarda el resultado en la variable $json*/
        $json = file_get_contents("https://randomuser.me/api/?results=50");
		//Decodificar json, extraer datos
		$datos = json_decode($json, true);
		//var_dump ($datos);
		?>
		<table>
			<tbody>
				<tr>
				<th>Genero</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Edad</th>
				<th>Ciudad</th>
				<th>País</th>
				<th>Teléfono</th>
				</tr>
			<?php foreach($datos["results"] as $dato){ ?>
			<tr>
			<td> <?php echo $dato["gender"]; ?> </td>
			<td> <?php echo $dato["name"]["first"]; ?> </td>
			<td> <?php echo $dato["name"]["last"]; ?> </td>
			<td> <?php echo $dato["dob"]["age"]; ?> </td>
			<td> <?php echo $dato["location"]["city"]; ?> </td>
			<td> <?php echo $dato["location"]["country"]; ?> </td>
			<td> <?php echo $dato["phone"]; ?> </td>
			</tr>
			<?php }?>
			
			</tbody>
		</table>		
		</section>		
	</body>
</html>