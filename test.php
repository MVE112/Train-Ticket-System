// Made by: Jacob Rothschild
// Sends the data to the Maria Database to update it.
<html>
<head>
	<style>
        body {
            background-color: rgb(112, 4, 4);
            text-align: center;
            color: rgb(255, 255, 255)
        }

        h1 {
            font: normal 50px algerian;
        }

        h2 {
            font: normal 30px algerian;
        }

        p {
            font: normal 18px calibri;
        }

        button {
            font: normal 18px calibri;
        }

        input {
            font: normal 18px calibri;
        }
		
		i {
			 font: normal 18px calibri;
		}

		</style>
</head>

<body>
	<h1> Ticket Confirmation </h1>

	<?php

	$servername = "localhost";
	$username = "root";
	$password = "1234";

	$conn = mysqli_connect($servername, $username, $password);
	$w = mysqli_query($conn, "USE db");
	if (!$conn)
	{
		die("Connection Failed: ".mysqli_connect_error());
	}

	function getNames($arr, $type, $num, $fnorln){
		for($i=0; $i<$num; $i++){
			if(isset($_GET[$fnorln.$type.strval($i+1)])){
				array_push($arr, $_GET[$fnorln.$type.strval($i+1)]);
			}
		}
		return($arr);
	}

	$fnadults = array();
	$lnadults = array();
	$fnchildren = array();
	$lnchildren = array();
	$route = "";
	$numadults = "";
	$numchildren= "";
	if(isset($_GET['route']) && isset($_GET['numadults']) && isset($_GET['numchildren'])){
		$route = $_GET['route'];
		$numadults = $_GET['numadults'];
		$numchildren = $_GET['numchildren'];

		$fnadults = getNames($fnadults, 'adult', $numadults, 'fn');
		$lnadults = getNames($lnadults, 'adult', $numadults, 'ln');

		$fnchildren = getNames($fnchildren, 'child', $numchildren, 'fn');
		$lnchildren = getNames($lnchildren, 'child', $numchildren, 'ln');
	}

	else if(isset($_GET['numadults']) && isset($_GET['numchildren'])){
		$numadults = $_GET['numadults'];
		$numchildren = $_GET['numchildren'];

		$fnadults = getNames($fnadults, 'adult', $numadults, 'fn');
		$lnadults = getNames($lnadults, 'adult', $numadults, 'ln');

		$fnchildren = getNames($fnchildren, 'child', $numchildren, 'fn');
		$lnchildren = getNames($lnchildren, 'child', $numchildren, 'ln');
	}
	?>

	<p>
	<?php
	function getRoute($route){
		if($route == "1"){
			return("Lubbock->Dallas");
		}
		else if($route == "2"){
			return("Lubbock->Houston");
		}
		else if($route == "3"){
			return("Lubbock->San Antonio");
		}
		else if($route == "4"){
			return("Lubbock->Corpus Christi");
		}
	}

	if(isset($route) && $route != ""){
		echo getRoute($route)."<br \> <br \> <br \>";
	}

	else {
		echo "You forgot to enter the route. <br \> <br \> <br \>";
	}

	if(isset($numadults) && $numadults != ""){
		echo "You purchased ".$numadults." ticket(s) for adults.";
	}
	else{
		$numadults = 0;
		echo "You forgot to enter the number of adults.";
	}


	for($i=0; $i<count($fnadults) && $i<count($lnadults); $i++){
		if($fnadults[$i]  != ""){
			echo "<br \> Adult ".strval($i+1)." first name: ";
			echo $fnadults[$i];
		}

		if($lnadults[$i]  != ""){
			echo "<br \> Adult ".strval($i+1)." last name: ";
			echo $lnadults[$i];
		}

		if($fnadults[$i] != "" || $lnadults[$i] != ""){
			echo "<br \>";
		}
	}

	echo "<br \><br \><br \>";


	if(isset($numchildren) && $numchildren != ""){
		echo "You purchased ".$numchildren." ticket(s) for children.";
	}

	else{
		$numchildren = 0;
		echo "You forgot to enter the number of children.";
	}

	for($i=0; $i<count($fnchildren) && $i<count($lnchildren); $i++){
		if($fnchildren[$i] != ""){
			echo "<br \> Child ".strval($i+1)." first name: ";
			echo $fnchildren[$i];
		}

		if($lnchildren[$i] != ""){
			echo "<br \> Child ".strval($i+1)." last name: ";
			echo $lnchildren[$i];
		}

		if($fnchildren[$i] != "" || $lnchildren[$i] != ""){
			echo "<br \>";
		}
	}
	$ti = mysqli_query ($conn, "SELECT ticketN FROM rou WHERE routeN = ".$route);
	$result = $ti->fetch_array()[0] ?? '';
	$combine = $numadults + $numchildren;
	$finalr = $result - $combine;
	$exe = $conn -> prepare("UPDATE rou SET ticketN = ? WHERE routeN = ?");
	$exe->bind_param("ii",$finalr, $route);
	$exe->execute();

	?>
	</p>

</body>

</html>
