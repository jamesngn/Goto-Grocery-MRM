<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add New Employee</h2>

    <form method="post" action="add_employee.php">
        <fieldset>
            <legend>Enter new employee details</legend>
            <p>
                <label for="fname">First name</label>
                <input type="text" name="fname" id="fname" pattern="^[A-Za-z-]+$" maxlength="50" required />
            </p>
            <p>
                <label for="lname">Last name</label>
                <input type="text" name="lname" id="lname" pattern="^[A-Za-z-]+$" maxlength="50" required />
            </p>
            <p>
                <label for="dob">Date Of Birth</label>
                <input type="text" name="dob" id="dob" placeholder="dd/mm/yyyy" required="required">
            </p>
            <p>
                <label for="job_role">Position</label>
                <input type="text" name="job_role" id="job_role" pattern="^[A-Za-z-]+$" maxlength="50" required />
            </p>
            <p>
                <label for="salary">Salary</label>
                <input type="text" name="salary" id="salary" maxlength="20" />
            </p>
            <p>
                <label for="hire_date">Hiring Date</label>
                <input type="text" name="hire_date" id="hire_date" placeholder="dd/mm/yyyy" required="required">
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
        $c_fname = mysqli_real_escape_string($conn, cleanInput($_POST['fname']));
        $c_lname = mysqli_real_escape_string($conn, cleanInput($_POST['lname']));
        $c_dob = mysqli_real_escape_string($conn, cleanInput($_POST['dob']));
        $c_job_role = mysqli_real_escape_string($conn, cleanInput($_POST['job_role']));
        $c_salary = mysqli_real_escape_string($conn, cleanInput($_POST['salary']));
        $c_hire_date = mysqli_real_escape_string($conn, cleanInput($_POST['hire_date']));
        
        // adding to database
        $sql = "INSERT INTO `employee` (`employee_ID`, `fname`, `lname`, `dob`, `job_role`, `salary`, `hire_date`) 
        VALUES ('$c_fname','$c_lname','$c_dob','$c_job_role','$c_salary','$c_hire_date')";

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

