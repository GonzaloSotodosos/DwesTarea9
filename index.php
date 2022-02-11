<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>T9</title>					
		<script>	
			/**
			* Funcion procesar 
			* Primero comprueba el valor del input, si es letra, genera la peticion,
			* recoge la respuesta del servidor y la muestra.
			* @param txt dato recogido del input
			*
			*/
			function procesar(txt){
				//Si txt es numero muestra el mensaje  en color rojo en error_texto
				if(/^\d+$/.test(txt)){
					document.getElementById("error_texto").innerHTML = "Formato incorrecto: solamente se puede escribir texto";
					document.getElementById("error_texto").style.color = "red";
				}
				//Sino hacemos la petición
				else{ 
					document.getElementById("error_texto").innerHTML = "";
					var xhr = new XMLHttpRequest();	
					/*abre la conexion con el fichero sugerenciaAutor.php pasandole por get el txt obtenido,
					el tercer parámetro es true ya que la peticion se realiza de forma asíncrona*/
					xhr.open("GET","sugerenciaAutor.php?nombre=" + txt, true);
					xhr.onreadystatechange = resultado;
					xhr.send(null);
				}
				/**
				* Funcion resultado
				* Procesa la respuesta del servidor. Si la respuesta es correcta, convierte el JSON en
				* un array, y con un bucle forEach lo va recorreindo mediante la funcion mostrarSugerencias
				*/
				function resultado(){
					if(xhr.readyState == 4 && xhr.status == 200){
						//limpiamos por si había algo antes
						document.getElementById("sugerencias").innerHTML = "";
						//como la respuesta del servidor es en formato JSON, la convertimos a un array
						var resultado = JSON.parse(xhr.responseText);						
						//para cada elemento del array, llamamos a mostrarSugerencias,
						//el forEach automaticamente pasa el elemento como parámetro
						resultado.forEach(mostrarSugerencias);
					}
					/**
					* Funcion mostrarSugerencias
					* Recibe una cadena y la añade al campo
					* sugerencias, con un salto de línea
					*/
					function mostrarSugerencias(texto){						
						document.getElementById("sugerencias").innerHTML += "</br>" +texto.nombre + "->" +texto.titulo+ "</br>";
						//document.getElementById("sugerencias").innerHTML += xhr.responseText;
					}
				}
			}		
		</script>
	</head>
	<body>		
		<p><b>Búsqueda de autores y libros:</b></p>
		<form id="formulario" action="index.php" method="GET">
		<!--Cada vez que tecleamos algo en este input se ejecutará procesar-->
			Carácter a buscar: 
			<input type="text" id="texto" onkeyup="procesar(this.value)">
			<!-- En el span con id="error_texto" mostraremos un mensaje de error si no son letras -->
			<span id="error_texto" ></span>
		</form>		
		<!-- En el span con id="sugerencias" mostraremos las coincidencias -->
		<p><strong>Sugerencias:</strong> <span id="sugerencias" style="color: #0080FF;"></span></p>		
	</body>
</html>
