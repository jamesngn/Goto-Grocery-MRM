<?php include '../includes/header.inc'; 
session_start();
?>

<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate employee ID for reading </h2>

    <form method="post" action="validate-employee_read.php">
        <fieldset>
            <legend>Enter Employee ID</legend>
            <p>
                <label for="employee_ID">Enter Employee ID</label>
                <input type="text" name="employee_ID" id="employee_ID" pattern="\d{1,10}" maxlength="10" required />
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
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $conn = OpenConnection();

            $c_ID = mysqli_real_escape_string($conn,cleanInput($_POST['employee_ID']));
            
            $sql = "SELECT * FROM employee WHERE employee_ID = '$c_ID'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br ("\r\n Error: Employee ID $c_ID is not found.");
                } else {
                    $employee = mysqli_fetch_assoc($result);
                    $_SESSION["employee_ID"] = $c_ID;
                    header("location: Read_employee.php");
                }
            } else {
                echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
        }
    ?>

<?php include '../includes/footer.inc'; ?>
</body>
</html>