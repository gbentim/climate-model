<?php
/**********************************************************
* File: index.php
* 
* Description:
***********************************************************/

// $dbUser = 'root';
// $dbPass = '';
$dbName = 'cc_model_db';
// $dbHost = 'localhost:3306'; 

$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
$dbPass = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');

$scenario = array(
	"emissions_growth" => "",
	"co2_ppm" => "",
	"co2_radiative_forcing" => "",
	"temp_increase" => "",
	"ocean_heat_storage" => "",
	"original_disaster_risk" => ""
	);


try
{
	// Create the PDO connection
	$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPass);

	// prepare the statement
	$statement = $db->prepare
					  ('SELECT emissions_growth, co2_ppm, co2_radiative_forcing, temp_increase, 
					  	ocean_heat_storage, original_disaster_risk FROM scenario');
	$statement->execute();

	// // Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		$scenario['emissions_growth'] = $row['emissions_growth'];
		$scenario['co2_ppm'] = $row['co2_ppm'];
		$scenario['co2_radiative_forcing'] = $row['co2_radiative_forcing'];
		$scenario['temp_increase'] = $row['temp_increase'];
		$scenario['ocean_heat_storage'] = $row['ocean_heat_storage'];
		$scenario['original_disaster_risk'] = $row['original_disaster_risk'];
	}

	// foreach ($scenario as $value)
	// 	echo "<p> $value </p>";

}
catch (PDOException $ex)
{
	echo "Error connecting to DB. Details: $ex";
	die();
}

include "view.php";
?>