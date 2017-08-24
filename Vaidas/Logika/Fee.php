<?php namespace Vaidas\Logika;

class Fee {

	private $i;

	// gets array values for each entity in euros: count of transactions per week and amount of transactions
	// per week.
	public function array_get_count_and_amount_eur_a_week(array $initial_data, $id, $date, $transaction ) {
		$count = 0;
		(double) $amount_a_week = 0;
		$search_array = array_slice($initial_data, 0, $this->i);
		
		foreach($search_array as $data) {
			if ($data[1] == $id && $transaction == $data[3]) {
				// finding the time interval for a current week.
				if((strtotime($data[0]) > strtotime('last monday', strtotime($date)) || strtotime($data[0]) == strtotime('monday this week', strtotime($date))) && strtotime($data[0]) <= strtotime($date) ) {
					//counting number of transactions during the current week.
					$count++;

					// calculating the amount of transactions during the current week in euros.
					switch ((string) trim($data[5])) {
						case 'EUR':
							$amount_a_week += (double) $data[4];
							break;
						case 'JPY':
							$amount_a_week += ((double) $data[4] / JPY);
							break;
						case 'USD':
							$amount_a_week += ((double) $data[4] / USD);
							break;

					}
				}
			}		
		}
		return [$count, $amount_a_week];
	}



// adding calculated data by array_get_count_and_amount_eur_a_week() to initial array
	public function add_columns(array $initial_data) {
		$result_array = [];
		$this->i = 0;
		foreach($initial_data as $data) {
			$this->i++;
			$result = $this->array_get_count_and_amount_eur_a_week($initial_data, $data[1], $data[0], $data[3]);
		
			array_push($data, $result[0]);
			array_push($data, $result[1]);
			array_push($result_array, $data);
		}
		return $result_array;
	}

// Fee calculation part
	public function cash_in($amount, $currency) {
		$fee = $amount * 0.0003;
		($fee > 5) ? $fee = 5 : $fee;
		switch(trim($currency)) {
			case "EUR":
				$fee = number_format(round_up($fee, 2), 2, '.', '');
				break;
			case "USD":
				$fee = number_format(round_up($fee / USD, 2), 2, '.', '');
				break;
			case "JPY":
				$fee = number_format(ceil($fee / JPY), 0, '.', '');
				break;
		}
		return number_format($fee, 2, '.', '');
	}


	public function cash_out($legal_form, $amount, $amount_a_week, $count, $currency) {
		// NATURAL
		$fee = 0.00;
		switch(trim($currency)) {
			case "EUR":
				$amount_eur = $amount;
				break;
			case "USD":
				$amount_eur= $amount / USD;
				break;
			case "JPY":
				$amount_eur = $amount / JPY;
				break;
		}
		if(trim($legal_form) == "natural") {
			if( $count <= 3 && $amount_eur != $amount_a_week ) {
				$former_transactions_amount = $amount_a_week - $amount_eur;
				$discount_left = 1000 - $former_transactions_amount;
				if($discount_left > $amount_eur) {
					$fee = 0.00;
					switch(trim($currency)) {
						case "EUR":
							$fee = number_format(round_up($fee, 2), 2, '.', '');
							break;
						case "USD":
							$fee = number_format(round_up($fee * USD, 2), 2, '.', '');
							break;
						case "JPY":
							$fee = number_format(ceil($fee * JPY), 0, '.', '');
							break;
					}

				} else {
					$fee = ($amount_eur - $discount_left) * 0.003;
					switch(trim($currency)) {
						case "EUR":
							$fee = number_format(round_up($fee, 2), 2, '.', '');
							break;
						case "USD":
							$fee = number_format(round_up($fee * USD, 2), 2, '.', '');
							break;
						case "JPY":
							$fee = number_format(ceil($fee * JPY), 0, '.', '');
							break;
					}
				}
			} elseif ($count <= 3 && $amount_eur == $amount_a_week) {
				$amount_to_fee = $amount_eur - 1000;
				if ($amount_to_fee > 0) {
					switch(trim($currency)) {
						case "EUR":
							$amount_to_fee = $amount_to_fee;
							break;
						case "USD":
							$amount_to_fee = $amount_to_fee * USD;
							break;
						case "JPY":
							$amount_to_fee = $amount_to_fee * JPY;
							break;
					}
					$fee = $amount_to_fee * 0.003;
					switch(trim($currency)) {
						case "EUR":
							$fee = number_format(round_up($fee, 2), 2, '.', '');
							break;
						case "USD":
							$fee = number_format(round_up($fee, 2), 2, '.', '');
							break;
						case "JPY":
							$fee = number_format(ceil($fee), 0, '.', '');
							break;
					}
				} else {
					$fee = number_format(0.00, 2, '.', '');
					switch(trim($currency)) {
						case "EUR":
							$fee = number_format(round_up($fee, 2), 2, '.', '');
							break;
						case "USD":
							$fee = number_format(round_up($fee, 2), 2, '.', '');
							break;
						case "JPY":
							$fee = number_format(ceil($fee), 0, '.', '');
							break;
					}
				}
				
			}
		// LEGAL
		} elseif(trim($legal_form) == "legal") {
			$fee = $amount * 0.003;
			($fee < 0.50) ? $fee = 0.50 : $fee;
			switch(trim($currency)) {
				case "EUR":
					$fee = number_format(round_up($fee, 2), 2, '.', '');
					break;
				case "USD":
					$fee = number_format(round_up($fee, 2), 2, '.', '');
					break;
				case "JPY":
					$fee = number_format(ceil($fee), 0, '.', '');
					break;
			}
			
		}
		return $fee;
	}






}
?>