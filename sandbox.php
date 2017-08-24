<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	
<?php 
$big_box = [
[1, 'cash_out', 234],
[2, 'cash_out', 234],
[2, 'cash_out', 234],
[3, 'cash_out', 234],
[1, 'cash_out', 234],
[2, 'cash_out', 234]
];


$small_box1 = array_slice($big_box, 2, 3);
echo "<pre>";
	echo print_r($small_box1);

echo "</pre>";


?>
</body>
</html>

