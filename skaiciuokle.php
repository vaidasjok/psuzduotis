<?php 
require_once("start.php"); 
use Vaidas\Logika\Fee as Fee;


// ****** DUOMENU RENGIMAS ******

// pradiniai failo input.csv duomenys issaugomi array forma
if (defined('STDIN')) {
	$initial_data = [];
	while($f = fgets(STDIN)){
		$to_array = explode(',', $f);

	    array_push($initial_data, $to_array);
	}
}


// TOLIAU GAUNAME DUOMENU MASYVA SU SEKANCIA STRUKTURA:
// [0] => data, [1] => id, [2] => juridine forma, [3] => operacijos tipas, [4] =>  operacijos suma,
// [5] => valiuta, [6] => operaciju kiekis per savaite, [7] => operaciju suma per savaite iki konkrecios operacijos.

// prie pradinio array paskaiciuojami ir pridedami papildomi duomenu stulpeliai su savaites operaciju
// skaiciumi ir savaites operacijos bendra isemimo suma. Tai atliekama PrepareArray klases metodu pagalba.
// Tai daroma tam, kad supaprastinti skaiciavimu procesa (skaiciavimai atliekami tik tarp masyvo stulpeliu).
$prepare = new Fee();
$array_elements = $prepare->add_columns($initial_data);

// ****** #DUOMENU RENGIMO PABAIGA ******

echo print_r($array_elements);



// ******* KOMISINIU SKAICIAVIMAS *******
$fees = [];
foreach($array_elements as $element) {
	if(trim($element[3]) == "cash_in") {
		array_push($fees, $prepare->cash_in($element[4], $element[5]));
	} elseif(trim($element[3]) == "cash_out") {
		array_push($fees, $prepare->cash_out($element[2], $element[4], $element[7], $element[6], $element[5]));
	}
}





foreach($fees as $fee) {
	fwrite(STDOUT, "$fee\n");
}








?>

