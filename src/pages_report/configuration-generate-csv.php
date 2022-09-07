<script src="../scripts/config-generate-csv.js"></script>
<?php include '../includes/header.inc'; 
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Confiugration for CSV</h2>
    <form onsubmit="return handleData()" method="post" action="generate-csv.php">
  		<!--Table Allocation-->
	<fieldset id="csv_table_name">
		<legend> Select tables to generate CSV file:</legend>
        <div style="visibility:hidden; color:red; " id="chk_option_error">
        Please select at least one option.
        </div>
			<p id="checkbox">	
                <label for="member">Member Data</label> 
				<input type="checkbox" id="member_mysql_table" name="Table[]" value="member"/>

				<label for="product">Product Data</label> 
				<input type="checkbox" id="product_mysql_table" name="Table[]" value="product"/>

                <label for="category">Catergory Data</label> 
				<input type="checkbox" id="category_mysql_table" name="Table[]" value="category"/>
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