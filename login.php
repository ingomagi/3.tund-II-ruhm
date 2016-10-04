<?php

	require("../../../config.php");
	require("functions.php");
	
	// kui on juba sisse loginud siis suunan data lehele
	if (isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: data.php");
		
	}
//get ja posti muutujad
//
	//var_dump ($_GET);
	//echo "<br>";
	//var_dump ($_POST);
	$signupPasswordError = "";
	$signupEmailError = "";
	$genderError = "";
	$ageError = "";
	$langError = "";
	$signupEmail="";
	$signupAge="";
	
	//on üldse olemas
	if(isset($_POST["signupEmail"]))
	{
		//jah on olemas
		//kas on tühi
		if(empty($_POST["signupEmail"]))
		{
			$signupEmailError = "see väli on kohustuslik";
		}else
			{ 
			$signupEmail=$_POST["signupEmail"];
			}
	}
	if(isset($_POST["signupPassword"]))
	{
				if(empty($_POST["signupPassword"]))
				{
			$signupPasswordError = "see väli on kohustuslik";
		} else{ 
			if (strlen ($_POST["signupPassword"])<8)
			{
			
				$signupPasswordError = "parool on lühem kui 8 märki";
			}
		}
	}	
	
	if(isset($_POST['Gender'])) 
	{
		if(empty($_POST["Gender"]))
		{
		$genderError = " Unustasite valida oma soo";
		}
	}
	if(isset($_POST['age'])) 
	{
		if(empty($_POST["age"]))
		{
		$ageError = " Unustasite sisestada oma sünnipäeva";
		}else
			{ 
			$signupAge=$_POST["age"];
			}
	}
	
	// peab olema email ja parool
	//ja ühtegi errorit ei olema
	if (  $signupEmailError == "" 
			&&
			$signupPasswordError == ""
			&&
			isset($_POST["signupEmail"])
			&&
			isset($_POST["signupPassword"])
		)
		{
			//salvestame andmebaasi
			echo "email: ".$signupEmail. "<br>";
			echo "password: ".$_POST["signupPassword"]."<br>";
			$password = hash("sha512", $_POST["signupPassword"]);
			echo "password hashed: ".$password."<br>";
			//echo $serverUsername;
			//ühendus
			$database = "if16_ingomagi";
			$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
			
			$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
			echo $mysqli->error;
			//stringina 1 täht iga muutuja kohta, mis tüüp
			// string - s
			//integer - i
			//float - (double -d)
			//?asendada väärtusega
			$stmt->bind_param("ss", $signupEmail, $password);
			if ($stmt->execute()){
					echo "salvestamine õnnestus";
			}	else {echo "error ".$stmt->error;}
	
			$stmt->close ();
			$mysqli->close();
	
		}
  ?>
 

 
 
 
<!DOCTYPE html>
<html>
<head>
<title>Logi sisse või loo kasutaja</title>
</head>
<body>
<body bgcolor="pink">
<h1>Logi sisse</h1>

<form method="POST">
  <input name="loginEmail" placeholder = "e-mail" type ="e-mail"> <br><br>
  <input name="loginPassword" placeholder = "parool" type ="password"> <br><br>
    <input type="submit" value="logi sisse">
  
</form>

<h1>Loo kasutaja</h1>

<form method="POST">

  <input name="signupEmail" placeholder = "e-mail" type ="e-mail" value="<?php echo $signupEmail;?>"> <?php echo $signupEmailError;?> <br><br>
  <input name="signupPassword" placeholder = "parool" type ="password"> <?php echo $signupPasswordError;?>  <br><br>

  valige oma sugu
  <select name="Gender">
	<option value="">...</option>
	<option value="mees">Mees</option>
	<option value="naine">Naine</option>
	<option value="meesnaine">muu</option>
  </select><?php echo $genderError;?>  <br><br>
  Sisestage oma sünnipäev<br> 
  <input name="age" placeholder = "päev/kuu/aasta" type ="age"value="<?php echo $signupAge;?>">
  <?php echo $ageError;?>  <br><br>
	Valige oma eelistatud suhtlus keel: <br>
	<input type="radio" name="Language" value="EST" checked />EST
	<input type="radio" name="Language" value="ENG"/>ENG
	<?php echo $langError;?>
  <br><br><input type="submit" value="loo kasutaja">
  
</form> 




</body>
</html>