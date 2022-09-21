<?php
include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>


    <h2>Customer Registration Form</h2>
    
	<form method="post" action="customer_registration.php">
	<fieldset><legend>New Manager Details</legend>
		<p>	<label for="email">Email: </label>
			<input type="text" name="email" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" maxlength="50" required /></p>
		<p>	<label for="password">Password: </label>
			<input type="text" name="password" id="password"  maxlength="50" required  /></p>
		
		<p>	<input type="submit" value="Add New Customer" /></p>
	</fieldset>
	</form>
	