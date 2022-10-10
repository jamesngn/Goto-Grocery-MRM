<script src="../js/config-generate-csv.js"></script>
<?php include '../includes/header.inc'; 
?>
<body>
    
    <h2>Confiugration for CSV</h2>
    <form id=list_table onsubmit="return handleData()" method="post" action="generate-csv.php">
  		<!--Table Allocation-->
	<fieldset id="csv_table_name">
		<legend> Select tables to generate CSV file:</legend>
        <div style="visibility:hidden; color:red; " id="chk_option_error">
        Please select at least one option.
        </div>
			<p id="checkbox">	
                <p>
                <label for="member">Member Data</label> 
				<input type="checkbox"  onclick='displayDateMemberQuestion(this)' id="member_mysql_table" name="Table[]" value="member"/>
               
                </p>
                <p>
				<label for="product">Product Data</label> 
				<input type="checkbox" id="product_mysql_table" name="Table[]" value="product"/>
                </p>
                <p>
                <label for="category">Catergory Data</label> 
				<input type="checkbox" id="category_mysql_table" name="Table[]" value="category"/>
                </p>
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
<?php
?>