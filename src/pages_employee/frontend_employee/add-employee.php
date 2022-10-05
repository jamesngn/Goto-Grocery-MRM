<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
    <?php 
        include '../includes/dbAuthentication.inc';

        $conn = OpenConnection();

        //select the latest id
        $sql = "SELECT employee_ID FROM employee";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $array = mysqli_fetch_row($result);
                $c_employee_ID = $array[0]+1;
            } else {
                $c_employee_ID = 100000;
            }
        } else {
            echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
        }

        $sql = "SELECT * FROM employee";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $c_employee_ID = mysqli_fetch_all($result);
            }
        } else {
            echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
        }
    ?>
        <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">ADD NEW EMPLOYEE</span>
        </div>

        <div class="form-container">
            <form action="add-employee.php" method="post"  enctype="multipart/form-data" id="addEmployeeForm">

                <div class="backButton">
                    <a href="product-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Employee Page</span>
                    </a>
                </div>

                <div class="text-input-container">
                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="productID">Employee ID</label>
                            <input type="text" name="employeeID" id="employeeID" value="<?php echo $c_employee_ID; ?>" readonly>
                        </div>
                        <div class="form-item">
                            <label for="displayName">First name</label>
                            <input type="text" name="displayName" id="displayName" required>
                        </div>
                        <div class="form-item">
                            <label for="displayName">Last name</label>
                            <input type="text" name="displayName" id="displayName" required>
                        </div>
                    

                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description">
                        </div>
                    </div>
                    
                    <div class="form-wrap">
                        <button class="add" type="submit" name="submit">Add</button>
                        <button type="reset" onclick="ResetInput()">Reset</button>
                    </div>
                </div>
            </form>
            
        </div>

    </section>

    <script src="../js/product.js"></script>    
    <script src="../js/sidebar.js"></script>       
</body>
</html>

<?php 

    function cleanInput($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include '../includes/dbAuthentication.inc';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $conn = OpenConnection();

        // the cleaned – "safe" – inputs ready to be added to the database
        $c_employee_ID = mysqli_real_escape_string($conn, cleanInput($_POST['employee_ID']));
        $c_fname = mysqli_real_escape_string($conn, cleanInput($_POST['fname']));
        $c_lname = mysqli_real_escape_string($conn, cleanInput($_POST['lname']));
        $c_email = mysqli_real_escape_string($conn, cleanInput($_POST['email']));
        $c_password = mysqli_real_escape_string($conn, cleanInput($_POST['password']));

        
        // adding to database
        $sql = "INSERT INTO employee (employee_ID, fname, lname, email, password)
        VALUES ('$c_employee_ID','$c_fname','$c_lname','$c_email','$c_password')";

            if (mysqli_query($conn,$sql)) {
                echo nl2br ("\r\n Added $c_fname $c_lname to the database.");
                    } else {
                echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
                    }
            CloseConnection($conn);
            }       
            ?>
            <?php include '../includes/footer.inc'; ?>
            <?php include '../includes/bootstrapcore.inc'; ?>
        </body>
        </html>
