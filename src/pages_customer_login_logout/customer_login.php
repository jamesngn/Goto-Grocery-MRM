<html lang="en">
<?php
include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <?php  
session_start();//session starts here  
  
?>  
	<h2>Log-in Form</h2>
	<form method="post" action="">
	<fieldset><legend>Customer Log-in</legend>
		<p>	<label for="email">Email: </label>
			<input type="text" name="email" id="email"  /></p>
		<p>	<label for="password">Password: </label>
			<input type="text" name="password" id="password"  /></p>
		<p>	<input type="submit" value="Log In" /></p>
	</fieldset>
	</form>
	   
	<hr />
	
	<?php
    if (isset($_POST["password"]) && isset($_POST["email"])){
		
		function sanitise_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
		
	$err_msg="";
	$password = $_POST["password"];
	$email = $_POST["email"];

 
	// password
	if (trim($password)=="")
		$err_msg .= "<p>Please enter password. </p>";
	else {
		$password=sanitise_input($password);
		if (!preg_match("/^[a-zA-Z0-9]{2,40}$/",$password)){
			$err_msg .= "<p>Only letters and number are allowed in password.</p>";
	}
	}
	// email
	if (trim($email) == "")
		$err_msg .= "<p>Please enter email.</p>";
	else {

		$email =  sanitise_input($email);
	}
	
	if ($err_msg!=""){
		echo $err_msg;
	    exit();
	}
	

	if ((!$password=="" && $email=="")){

	include '../includes/dbAuthentication.inc';
        
    
	
	$conn = OpenConnection();
  
	// Checks if connection is successful
	if (!$conn) {
		// Displays an error message
		echo "<p >Database connection failure</p>";  
	} else {
		// Upon successful connection
		echo nl2br("\r\n SQL error:1 ");
	$sql_table="member";
	
		// Setting up the SQL command to add the data into the table
		$query = "SELECT * from $sql_table WHERE customer_password = '$password' AND customer_email= '$email' ";
	
			
		// executing the query and store result into the result pointer
		$result = mysqli_query($conn, $query);
		
		// checks if the execuion was successful
		if(!$result) {
	

			echo "<p >Something is wrong with ",	$query, "</p>";
		} else {
			 $_SESSION['password']=$password;//here session is used and value of $password stored in $_SESSION.
        //echo "<script>window.open('../functions.php','_self')</script>";  
		header('location: ../functions.php');
  
		} 
		} 
		// close the database connection
		mysqli_close($conn);
	} 
	} 
?>

 

</body>
</html>