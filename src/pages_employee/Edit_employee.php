
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
                <label for="employee_email">Email address</label>
                <input type="text" name="employee_email" id="employee_email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" maxlength="50" required value = "<?php echo $employee['email'];?>" />
            </p>
            <p>   
                <label for="employee_password">Password</label>
                <input type="text" name="employee_password" id="employee_password" maxlength="50" required value = "<?php echo $employee['password'];?>" />
            </p>
            <p>
          
           
            
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
        
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $conn = OpenConnection();
            
            $c_employee_fname = mysqli_real_escape_string($conn, cleanInput($_POST['employee_fname']));
            $c_employee_lname = mysqli_real_escape_string($conn, cleanInput($_POST['employee_lname']));
            $c_employee_email = mysqli_real_escape_string($conn, cleanInput($_POST['employee_email']));
            $c_employee_password = mysqli_real_escape_string($conn, cleanInput($_POST['employee_password']));

            $sql = 
            "UPDATE employee 
            SET 
                
                fname = '$c_employee_fname',
            lname = '$c_employee_lname',
            email = '$c_employee_email',
            password = '$c_employee_password'
                
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

