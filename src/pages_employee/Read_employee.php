
<?php include '../includes/header.inc';
session_start();
$regValue = $_SESSION["employee_ID"];
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read Employee</h2>
    
    <?php
    echo nl2br("\r\n". $_SESSION["employee_ID"]);
    $c_ID = $_SESSION["employee_ID"];
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();
    $sql = "SELECT * FROM employee WHERE employee_ID = '$c_ID' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)>0)
                { 
                    while($row = $result->fetch_assoc())
                    {
                    
                    echo nl2br("\r\n Employee ID: " . $row["employee_ID"]);
                    echo nl2br("\r\n First Name: ". $row["fname"]); 
                    echo nl2br("\r\n Last Name " . $row["lname"]);
                    echo nl2br("\r\n DOB:" . $row["dob"]);
                    echo nl2br("\r\n Position:" . $row["job_role"]);
                    echo nl2br("\r\n Salary:" . $row["salary"]);
                    echo nl2br("\r\n Date Hired:" . $row["hire_date"]);
                    
                    }
                    session_unset();
                    session_destroy();
                }
                else{
              
                    echo nl2br("\r\n Error:DB is incorrect.");
            
                }              
            }
            else
            {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
    CloseConnection($conn);
    ?>

    <?php include '../includes/footer.inc'; ?>
</body>

</html>