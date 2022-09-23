<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add New Employee</h2>

    <form method="post" action="Add_employee.php">
        <fieldset>
            <legend>Enter new employee details</legend>
            <p>
                <label for="employee_ID">Employee ID</label>
                <input type="text" name="employee_ID" id="employee_ID" pattern="\d{1,10}" maxlength="50" required />
            </p>
            <p>
                <label for="fname">First name</label>
                <input type="text" name="fname" id="fname" pattern="^[A-Za-z-]+$" maxlength="50" required />
            </p>
            <p>
                <label for="lname">Last name</label>
                <input type="text" name="lname" id="lname" pattern="^[A-Za-z-]+$" maxlength="50" required />
            </p>
            <p>
                <label for="email">Email address</label>
                <input type="text" name="email" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" maxlength="50" required />
            </p>
            <p>   
                <label for="password">Password</label>
                <input type="text" name="password" id="password" maxlength="50" required />
            </p>
            <p>
            <input type="submit" value="Submit">
            <input type="reset"> 
            </p>
        </fieldset>
    </form>


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

