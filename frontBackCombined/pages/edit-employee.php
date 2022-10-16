<?php
    function editEmployee($fname,$lname,$email,$employeeID)
    {
        function cleanInput($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        require '../includes/dbAuthentication.inc';
        // put all the stuff to be done following form submission in here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conn = OpenConnection();


            $fname = mysqli_real_escape_string($conn, cleanInput($_POST['fname']));
            $lname = mysqli_real_escape_string($conn, cleanInput($_POST['lname']));
            $email = mysqli_real_escape_string($conn, cleanInput($_POST['email']));

            // add to the database

            $sql =
                "UPDATE employee 
            SET 
                fname ='$fname', 
                lname = '$lname', 
                email = '$email'
            WHERE employee_ID = '$employeeID'";

            $stmt = $conn->prepare($sql);


            try {
                $stmt->execute();
                return true;
              }
              
              //catch exception
              catch(Exception $ignored) {
                
                return false;
              }
              return false;
        }
    }
    function readEmployee($employeID)
    {
        if ($employeID) {
            require '../includes/dbAuthentication.inc';
            $conn = OpenConnection();
    
            $sql = "SELECT * FROM employee WHERE employee_ID = '$employeID'";
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
    
                    $employee = mysqli_fetch_assoc($result);
                    return $employee;
                }
            } else {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
        }
    }
    function hasEmployee($employeeID)
    {
        if (is_null($employeeID)) {
            return false;
        } else {
            return true;
        }
    }

    ?>

