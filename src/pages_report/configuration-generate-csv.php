<?php include '../includes/header.inc'; 
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Confiugration for CSV</h2>
    <form method="post" action="generate-csv.php">
  		<!--Table Allocation-->
	<fieldset id="csv_table_name">
		<legend> csv_table_name</legend>
			<p id="checkbox">	
                <label for="member">Member Data</label> 
				<input type="checkbox" id="member" name="Table[]" value="member"/>

				<label for="product">Product Data</label> 
				<input type="checkbox" id="product" name="Table[]" value="product"/>

                <label for="category">Catergory Data</label> 
				<input type="checkbox" id="category" name="Table[]" value="category"/>
			</p>
            <p>
            <input type="submit" value="Submit">
            <input type="reset"> 
            </p>
		</fieldset>
    </form>
    <?php include '../includes/footer.inc'; ?>
    </body>
<!--Author:THANH NGUYEN DATE:07/09/2022-->
</html>