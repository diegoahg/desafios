<?php
/*
****AUTOR: Diego Hernández García.
****FECHA: 31-10-2017
****PROGRAMA: SUMAS MAXIMAS DE ARREGLOS CONTIGUOS Y NO-CONTIGUOS
*/

 
//Funcion para saber si es entero
function esEntero($numero){

	if(is_numeric($numero)){
		if($numero == "0"){
			return true;
		}
		if(((int)$numero)/$numero==1){
			return true;
		}
	}
	return false;
}

//Función de que suma todos los numeros del arreglo de forma contigua
//Lógica: Suma todas las posibilidades de tal forma que no se repiten las convinaciones que se suman. Guarda cada posibilidad y devuelve la suma mas grande.
function sumaContigua($arreglo){
	$maxima_suma=0;
	for($i=0; $i<count($arreglo); $i++){
	    $suma=0;
	    for($j=$i; $j<count($arreglo); $j++){
	        $suma += $arreglo[$j];
	        if($suma>$maxima_suma){
	            $maxima_suma=$suma;
	        }
	    }
	}
	return $maxima_suma;
}

//Función de que suma todos los numeros del arreglo de forma contigua
//Lógica: Suma solo los datos que son mayores a 0
function sumaNoContigua($arreglo){
	$maxima_suma=0;
	for($i=0; $i<count($arreglo); $i++){
        if($arreglo[$i]>0){
            $maxima_suma+=$arreglo[$i];
        }
	}
	return $maxima_suma;

}

//Función que verifica si es número, devuelve un arreglo con el estado (true o false), un mensaje y el numero(solo en caso que sea true)
function esNumero($numero, $filtro){
	$response =  array("estado" => "false", "mensaje" => "Dato no es entero o numerico", "numero" => 0);
	if(esEntero($numero)){
			$valido = false;
			switch ($filtro) {
				case '1':
					$rango = "1 a 10";
					if($numero>=1 && $numero<=10){
						$valido = true;
					}
					break;
				case '2':
					$rango = "1 a 100.000";
					if($numero>=1 && $numero<=pow(10,5)){
						$valido = true;
					}
					break;
			}
			if($valido == true){
				$response =  array("estado" => "true", "mensaje" => "Dato es entero y esta dentro del rango", "numero" => (int)$numero);
			}else{
				$response =  array("estado" => "false", "mensaje" => "Dato es entero y pero debe estar dentro del rango $rango", "numero" => 0); 
			}
	}
	return $response;
}

//Función que verifica si el arreglo trae solo números, devuelve un arreglo con el estado (true o false), un mensaje y el arreglo(solo en caso que sea true)
function esArregloNumero($arreglo, $cantidad_total){
	$response =  array("estado" => "false", "mensaje" => "Uno o mas datos de la secuencia no es un numero valido", "arreglo" => 0);
	$arreglo = explode(" ", $arreglo);
	$arreglo_aux = array();
	$contador_negativos = 0;
	if(count($arreglo) != $cantidad_total){
		$response =  array("estado" => "false", "mensaje" => "La cantidad de datos debe ser $cantidad_total", "arreglo" => $arreglo);
		return $response;
	}else{
		for($i=0; $i<count($arreglo); $i++){
			if($arreglo[$i] < 0){
				$contador_negativos++;
			}
			if(esEntero($arreglo[$i])){
				if($arreglo[$i]>=(-pow(10,4)) && $arreglo[$i]<=pow(10,4)){
					$arreglo_aux[$i] = $arreglo[$i];
				}else{
					$response =  array("estado" => "false", "mensaje" => "El arreglo contiene datos que superan el rango permitido", "arreglo" => 0);
					return $response;
				}
			}else{
				$response =  array("estado" => "false", "mensaje" => "El arreglo contiene datos no numericos o enteros", "arreglo" => 0);
				return $response;
			}
		}
		if($contador_negativos == $cantidad_total){
			$response =  array("estado" => "false", "mensaje" => "Al menos un elemento debe ser positivo para que El subarreglo y subsecuencias que consideres deberían tener al menos un elemento.", "arreglo" => 0);
			return $response;
		}
		if(count($arreglo_aux) == $cantidad_total){
			$response =  array("estado" => "true", "mensaje" => "El arreglo no es valido, contiene caracteres no permitidos", "arreglo" => $arreglo);
			return $response;
		}

	}
	

	
	
	return $response;
}

//Valida que el input este ingresado de la forma que se pidió
function inputValidacion($response, $comando, $texto_adicional, $filtro){
	while ($response["estado"] == "false") {
		echo $response["mensaje"]. ", por favor ingrese de nuevo la informacion ".$texto_adicional.":".PHP_EOL;
		$linea = fgets($comando);
		$response = esNumero(trim($linea), $filtro);
	}
	return $response;
}

//Valida que el arreglo este ingresado de la forma que se pidió
function inputValidacionArreglo($response, $comando, $texto_adicional, $responseCantidad){
	while ($response["estado"] == "false") {
		echo $response["mensaje"]. ", por favor ingrese denuevo la inforamcion ".$texto_adicional.":".PHP_EOL;
		$linea = fgets($comando);
		$response = esArregloNumero(trim($linea), $responseCantidad["numero"]);
	}
	return $response;
}


//Imprime todos los inputs
function input($casos,$cantidades,$arreglo){
	echo PHP_EOL;
	echo "=====INPUT======".PHP_EOL;
	echo $casos.PHP_EOL;
	for($i=1; $i<=$casos;$i++){
		echo $cantidades[$i].PHP_EOL;
		for($j=0; $j<$cantidades[$i];$j++){
			echo $arreglo[$i][$j]." ";
		}
		echo PHP_EOL;
	}
}

//Imprime todos los outputs
function output($casos,$arreglo){
	echo PHP_EOL;
	echo "=====OUTPUT======".PHP_EOL;
	$tiempo_inicio = microtime(true);
	for($i=1; $i<=$casos;$i++){
			$output[$i]["contigua"] = sumaContigua($arreglo[$i]);
			$output[$i]["no_contigua"] = sumaNoContigua($arreglo[$i]);
			echo $output[$i]["contigua"]." ".$output[$i]["no_contigua"].PHP_EOL;
		}
	$tiempo_fin = microtime(true);
	echo PHP_EOL;
	echo "Tiempo de calculo: " . ($tiempo_fin - $tiempo_inicio). " seg";
}

//Programa principal, se ejecuta a penas hecha a correr el algoritmo.
function main(){
	echo "*********PROGRAMA: SUMAS MAXIMAS DE ARREGLOS CONTIGUOS Y NO-CONTIGUOS********".PHP_EOL.PHP_EOL;
	//Se inicializan los array de input y output
	$input  = array();
	$output = array();

	echo "Ingrese cantidad de casos de prueba: ".PHP_EOL;

	//se lee la variable casos en la consola
	$comando = fopen ("php://stdin","r");
	$linea = fgets($comando);

	//valida si es numero o no, pregunta hasta que se ingrese bien la información.
	$responseCasos = esNumero(trim($linea), "1");
	$texto_adicional = "del numero de casos";
	$responseCasos  = inputValidacion($responseCasos, $comando, $texto_adicional, 1);

	//Ciclo for para la cantidad de casos
	for($i=1; $i<=$responseCasos["numero"];$i++){

		//texto adicional para la validación
		$texto_adicional = "de la cantidad del caso $i";

		//Se leen laa variable cantidad en la consola 
		echo "Ingrese cantidad de elementos del caso $i: ".PHP_EOL;
		$linea = fgets($comando);

		//valida si es numero o no, pregunta hasta que se ingrese bien la información.
		$responseCantidad = esNumero(trim($linea), "2");
		$responseCantidad  = inputValidacion($responseCantidad, $comando, $texto_adicional, 2);

		//guarda la variable en un array cantidades para se impresas en la funcion input()
		$input["cantidades"][$i] = $responseCantidad["numero"];

		//texto adicional para la validación
		$texto_adicional = "de ".$responseCantidad["numero"]. " enteros separados por espacio";

		//Se leen los N elemento en la consola 
		echo "Ingrese ".$responseCantidad["numero"]. " enteros separados por espacio: ".PHP_EOL;
		$linea = fgets($comando);

		//valida si es el arreglo contiene numero o no, pregunta hasta que se ingrese bien la información.
		$responseArreglo = esArregloNumero(trim($linea), $responseCantidad["numero"]);
		$responseArreglo  = inputValidacionArreglo($responseArreglo, $comando, $texto_adicional, $responseCantidad);

		//guarda la variable en un array cantidades para se impresas en la funcion input()
		$input["arreglos"][$i] = $responseArreglo["arreglo"];

	}

	//imprime los input's y output's
	input($responseCasos["numero"],$input["cantidades"],$input["arreglos"]);
	output($responseCasos["numero"],$input["arreglos"]);

	
	fclose($comando);
	echo "\n".PHP_EOL; 
	echo "Desarrollado por Diego Hernandez Garcia, Ingeniero de Software.".PHP_EOL;
}
 
main();




