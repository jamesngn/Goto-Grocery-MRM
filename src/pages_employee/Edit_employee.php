<?php 
    include '../includes/dbAuthentication.inc';
    session_start();

    $c_ID = $_SESSION['employee_ID'];
    $conn = OpenConnection();
    
    $sql = "SELECT * FROM employee WHERE employee_ID = $c_ID";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $employee = mysqli_fetch_assoc($result);
    }  else {
        echo "\r\nSQL error: " . mysqli_error($conn);
    }
    CloseConnection($conn);
?>

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
                <input type="text" name="salary" id="salary" pattern="^[A-Za-z-]+$" maxlength="20" required />
            </p>
            <p>
                <label for="hire_date">Hiring Date</label>
                <input type="text" name="hire_date" id="hire_date" placeholder="dd/mm/yyyy" required="required">
            </p>
            <p>
            <button type="submit">Edit</button>
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

        $sql = 
        "UPDATE product 
        SET 
        fname = '$c_fname',
            lname = '$c_lname',
            dob = '$c_dob',
            job_role = '$c_job_role',
            salary = '$c_salary',
            hire_date = '$c_hire_date',
        WHERE employee_ID = $employee_ID";

        if (mysqli_query($conn, $sql)) {
            echo "\r\nDetails updated successfuly";
            session_unset();
            session_destroy();
        } else {
            echo "\r\nError updating the details: " . mysqli_error($conn);
        }

        CloseConnection($conn);
    }
?>
  <?php include '../includes/footer.inc'?>
</body>
</html>