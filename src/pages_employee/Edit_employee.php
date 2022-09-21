

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




<?php
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'?>
    <h2>Edit Employee Page</h2>
    <form action="Edit_employee.php" method="post">
        <fieldset>
            <legend>Edit Employee Details</legend>
            <p>
                <label for="employee_fname">First name</label>
                <input type="text" name="employee_fname" id="employee_fname" pattern="^[A-Za-z-]+$" maxlength="50" required value = "<?php echo $employee['fname'];?>">
            </p>
            <p>
                <label for="employee_lname">Last name</label>
                <input type="text" name="employee_lname" id="employee_lname" pattern="^[A-Za-z-]+$" maxlength="50" required value = "<?php echo $employee['lname'];?>">
            </p>
            <p>
                <label for="employee_dob">Date Of Birth</label>
                <input type="text" name="employee_dob" id="employee_dob" placeholder="dd/mm/yyyy" required="required" value = "<?php echo $employee['dob'];?>">
            </p>
            <p>
                <label for="employee_job_role">Position</label>
                <input type="text" name="employee_job_role" id="employee_job_role" pattern="^[A-Za-z-]+$" maxlength="50" required value = "<?php echo $employee['job_role'];?>">
            </p>
            <p>
                <label for="employee_salary">Salary</label>
                <input type="text" name="employee_salary" id="employee_salary" pattern="\d{1,15}" required value = "<?php echo $employee['salary'];?>">
            </p>
            <p>
                <label for="employee_hire_date">Hiring Date</label>
                <input type="text" name="employee_hire_date" id="employee_hire_date" placeholder="dd/mm/yyyy" required="required" value = "<?php echo $employee['hire_date'];?>">
            </p>
           
            
            <button type="submit">Edit</button>
            <button type="reset">Reset</button>
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
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $conn = OpenConnection();

            $c_employee_fname = mysqli_real_escape_string($conn, cleanInput($_POST['employee_fname']));
            $c_employee_lname = mysqli_real_escape_string($conn, cleanInput($_POST['employee_lname']));
            $c_employee_dob = mysqli_real_escape_string($conn, cleanInput($_POST['employee_dob']));
            $c_employee_job_role = mysqli_real_escape_string($conn, cleanInput($_POST['employee_job_role']));
            $c_employee_salary = mysqli_real_escape_string($conn, cleanInput($_POST['employee_salary']));
            $c_employee_hire_date = mysqli_real_escape_string($conn, cleanInput($_POST['employee_hire_date']));
            

            $sql = 
            "UPDATE employee 
            SET 
                
                fname = '$c_employee_fname',
            lname = '$c_employee_lname',
            dob = '$c_employee_dob',
            job_role = '$c_employee_job_role',
            salary = '$c_employee_salary',
            hire_date = '$c_employee_hire_date'
                
            WHERE employee_ID = $c_ID";

            if (mysqli_query($conn, $sql)) {
                echo "\r\nRecord updated successfully";
                session_unset();
                session_destroy();
            } else {
                echo "\r\nError updating record: " . mysqli_error($conn);
            }

            CloseConnection($conn);
        }
    ?>
    
    <?php include '../includes/footer.inc'?>
</body>
</html>

