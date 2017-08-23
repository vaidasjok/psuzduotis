<?php namespace Vaidas\Logika;

class Fee {


	// gets array values for each entity in euros: count of transactions per week and amount of transactions
	// per week.
	public function array_get_count_and_amount_eur_a_week(array $initial_data, $id, $date ) {
		$count = 0;
		(double) $amount_a_week = 0;
		foreach($initial_data as $data) {
			if ($data[1] == $id) {
				// finding the time interval for a current week.
				if(strtotime($data[0]) > strtotime('last monday', strtotime($date)) && strtotime($data[0]) <= strtotime($date)) {
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
		foreach($initial_data as $data) {
			$result = $this->array_get_count_and_amount_eur_a_week($initial_data, $data[1], $data[0]);
		
			array_push($data, $result[0]);
			array_push($data, $result[1]);
			array_push($result_array, $data);
		}
		return $result_array;
	}

// Fee calculation part
	public function cash_in($amount, $currency) {
		$fee = $amount * 0.003;
		($fee > 5) ? $fee = 5 : $fee;
		switch(trim($currency)) {
			case "EUR":
			case "USD":
				$fee = number_format(round_up($fee, 2), 2, '.', '');
				break;
			case "JPY":
				$fee = number_format(ceil($fee), 0, '.', '');
				break;
		}
		return number_format($fee, 2, '.', '') . "/";
	}


	public function cash_out($legal_form, $amount, $amount_a_week, $count, $currency) {
		// NATURAL
		if($legal_form == "natural") {
		//if less that 3 times and if less than 1000€ - no fee
			if($count <= 3 && $amount <= 1000.00) {
				$fee = number_format(0.00, 2, '.', '');
			} elseif($count > 3 || $amount > 1000.00) {
		// if more than 3 times or if more than 1000€ - 0.003 (0.3%)
				$fee = $amount * 0.003;
				switch(trim($currency)) {
					case "EUR":
					case "USD":
						$fee = number_format(round_up($fee, 2), 2, '.', '');
						break;
					case "JPY":
						$fee = number_format(ceil($fee), 0, '.', '');
						break;
				}
			}
		// LEGAL
		} elseif($legal_form == "legal") {
			$fee = $amount * 0.003;
			($fee < 0.50) ? $fee = 0.50 : $fee;
			switch(trim($currency)) {
				case "EUR":
				case "USD":
					$fee = number_format(round_up($fee, 2), 2, '.', '');
					break;
				case "JPY":
					$fee = number_format(ceil($fee), 0, '.', '');
					break;
			}
			
		}
		return $fee . "/";
	}






}
?>