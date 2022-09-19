<?php include '../includes/header.inc';
session_start();
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read employee</h2>
    
    <?php
    echo nl2br("\r\n". $_SESSION["employee_ID"]);
    $c_ID = $_SESSION["employee_ID"];
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();
    $sql = "SELECT * FROM employee WHERE employee_ID = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("id", $c_ID);
    
            if($stmt->execute())
            {
                $result=$stmt->get_result();
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
                    if(!session_destroy())
                    {
                      echo "session not destroyed";
                    }
                    else {
                      echo "session is destroyed!";
                    }
                }
                else{
                    echo nl2br("\r\n Error: Incorrect");
                }
                
            }
            else
            {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
    $stmt->close();
    CloseConnection($conn);
    ?>
    <?php include '../includes/footer.inc'; ?>
    <?php include '../includes/bootstrapcore.inc'; ?>
</body>
</html>