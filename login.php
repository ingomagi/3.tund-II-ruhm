<?php


//


//get ja posti muutujad

	//var_dump ($_GET);
	//echo "<br>";
	//var_dump ($_POST);
	$signupPasswordError = "";
	$signupEmailError = "";
	$genderError = "";
	$ageError = "";
	$langError = "";
	
	//on üldse olemas
	if(isset($_POST["signupEmail"]))
	{
		//jah on olemas
		//kas on tühi
		if(empty($_POST["signupEmail"]))
		{
			$signupEmailError = "see väli on kohustuslik";
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
		}
	}
	if(isset($_POST['Language'])) 
	{
		if(empty($_POST["Language"]))
		{
		$langError = " Unustasite valida keele";
		}
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
  <input name="signupEmail" placeholder = "e-mail" type ="e-mail"> <?php echo $signupEmailError;?> <br><br>
  <input name="signupPassword" placeholder = "parool" type ="password"> <?php echo $signupPasswordError;?>  <br><br>

  valige oma sugu
  <select name="Gender">
	<option value="">...</option>
	<option value="mees">Mees</option>
	<option value="naine">Naine</option>
	<option value="meesnaine">muu</option>
  </select><?php echo $genderError;?>  <br><br>
  Sisestage oma sünnipäev<br> 
  <input name="age" placeholder = "päev/kuu/aasta" type ="age">
  <?php echo $ageError;?>  <br><br>
	Valige oma eelistatud suhtlus keel: <br>
	<input type="radio" name="Language" value="EST"/>EST
	<input type="radio" name="Language" value="ENG"/>ENG
	<?php echo $langError;?>
  <br><br><input type="submit" value="loo kasutaja">
  
</form>




</body>
</html>