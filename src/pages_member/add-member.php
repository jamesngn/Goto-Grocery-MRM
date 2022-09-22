<?php
session_start();
include '../php/time-page.php';
$startpage = StartTime();
include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add New Member</h2>

    <form method="post" action="">
        <fieldset>
            <legend>Enter new member details</legend>
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
        // put all the stuff to be done following form submission in here
       if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $conn = OpenConnection();
            
            // the cleaned – "safe" – inputs ready to be added to the database
            $c_fname = mysqli_real_escape_string($conn, cleanInput($_POST["fname"]));
            $c_lname = mysqli_real_escape_string($conn, cleanInput($_POST["lname"]));
            $c_email = mysqli_real_escape_string($conn, cleanInput($_POST["email"]));
            $c_password = mysqli_real_escape_string($conn, cleanInput($_POST["password"]));

            // add to the database

            $sql = 
            "INSERT INTO member (customer_firstname, customer_lastname, customer_email, customer_password)
            VALUES (?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $c_fname,$c_lname,$c_email, $c_password);

            if ($stmt->execute())
            {
                //echo nl2br("\r\n Added customer $c_fname $c_lname to the database.");
                $_SESSION["firstname"] = $c_fname;
                $_SESSION["lastname"] = $c_lname;
                header('location: sucess-add-member.php');
            }
            else
            {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
            $stmt->close();
            CloseConnection($conn);
          //  $conn->close();
        }
    ?>
    <?php include '../includes/footer.inc'; ?>
    <?php include '../includes/bootstrapcore.inc'; ?>
</body>
<!--Author:THANH NGUYEN  Hello DATE:05/09/2022-->
</html>
<?php
$display_page_time = StopTime($startpage);
echo $display_page_time;
?>
