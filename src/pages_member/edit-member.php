<?php include '../includes/header.inc';
session_start();
$regValue = $_SESSION["memberID"];

?>

<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Edit Current Member</h2>


    <form method="post" action="edit-member.php">
        <fieldset>
            <legend>Enter new member details</legend>
            <p>
                <label for="fname">First name</label>
                <input type="text" name="fname" id="fname" required />
            </p>
            <p>
                <label for="lname">Last name</label>
                <input type="text" name="lname" id="lname" required />
            </p>
            <p>
                <label for="email">Email address</label>
                <input type="text" name="email" id="email" required />
            </p>
            <p>
            <input type="submit" value="Submit">
            <input type="reset"> 
            </p>
        </fieldset>
    </form>

    <?php
    $c_memberID = $_SESSION["memberID"];
  
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
        /*  $servername = "sql213.epizy.com";
            $username = "epiz_32522623";
            $password = "tgaBdbN4MPFDQu";
            $dbname = "epiz_32522623_gotogromrmDB";
    
            // Create connection
            $conn = mysqli_connect($servername, $username, $password,$dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            echo "Sucess Connection";
*/
            $conn = OpenConnection();

            // the cleaned – "safe" – inputs ready to be added to the database
            $c_fname = mysqli_real_escape_string($conn, cleanInput($_POST["fname"]));
            $c_lname = mysqli_real_escape_string($conn, cleanInput($_POST["lname"]));
            $c_email = mysqli_real_escape_string($conn, cleanInput($_POST["email"]));

            // add to the database

            $sql = 
            "UPDATE member 
            SET customer_firstname=$c_fname, 
            customer_lastname=$c_lname, 
            customer_email= $c_email 
            WHERE customer_id = 5";

            if (mysqli_query($conn, $sql))
            {
                echo nl2br("\r\n Edited customer $c_fname $c_lname to the database.");
            }
            else
            {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
          //  $conn->close();
        }
    ?>

    <?php include '../includes/footer.inc'; ?>
</body>
</html>

