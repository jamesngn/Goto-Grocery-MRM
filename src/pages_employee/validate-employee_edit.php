
<?php session_start();
include '../includes/header.inc'; 
?>

<body>
    <?php include '../includes/menu.inc';?>
    <h2>Validate Employee ID for editting</h2>

    <form action="validate-employee_edit.php" method="post">
        <fieldset>
            <legend>Enter the employee ID</legend>
            <p>
                <label for="employeeID">Employee ID:</label>
                <input type="text" name="employee_ID" id="employee_ID" pattern="\d{1,10}" maxlength="10" required>
            </p>

            <p>
                <button type="submit">Search</button>
                <button type="reset">Reset</button>
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
            //Connect to the database and store it in variable $conn.
            $conn = OpenConnection();
            //Clean the id value to prevent from attack.
            $c_ID = mysqli_real_escape_string($conn, cleanInput($_POST['employee_ID']));
            //select the row from the employee table to match with the input id.
            $sql = "SELECT * FROM employee WHERE employee_ID = $c_ID";
            //perform a query against the database.
            $result = mysqli_query($conn, $sql);
            //validation check
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Employee ID $c_ID is not found.");
                } else {
                    $_SESSION['employee_ID'] = $c_ID;
                    header("location:Edit_employee.php");
                }
            }
            else {
                echo nl2br("\r\nSQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
        }

    ?>

    <?php include '../includes/footer.inc';?>
</body>