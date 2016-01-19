<?php

$mpg= $_POST['mpg'];
$distance = $_POST['distance'];
$pricePerGallon = $_POST['price_per_gallon'];
$gallons = $distance / $mpg;
$totalCost = round($gallons * $pricePerGallon, 2);
echo "Total Cost = $$totalCost";


$servername = 'localhost';
$username   = 'root';
$password   = '';
$dbname     = 'trip_calculator';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //shows errors

//prepare sql and bind parameters
$stmt = $conn->prepare("INSERT INTO input_data (mpg, distance, price_per_gallon, total_cost) 
						VALUES (:mpg, :distance, :price_per_gallon, :total_cost)");
$stmt->bindParam(':mpg', $mpg);
$stmt->bindParam(':distance', $distance);
$stmt->bindParam(':price_per_gallon', $pricePerGallon);
$stmt->bindParam(':total_cost', $totalCost);
$stmt->execute();
/*
for ($x = 0; $x <= 1000000; $x++) {
	$stmt->execute();
}*/