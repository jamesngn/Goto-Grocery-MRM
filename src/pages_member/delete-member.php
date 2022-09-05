<?php include '../includes/header.inc';
session_start();
$regValue = $_SESSION["memberID"];

?>

<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Delete Current Member</h2>


    <?php
    $c_memberID = $_SESSION["memberID"];
  

        include '../includes/dbAuthentication.inc';
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

            $sql = 
            "DELETE FROM member 
            WHERE customer_id = $c_memberID";

            if (mysqli_query($conn, $sql))
            {
                echo nl2br("\r\n Delete customer $c_memberID from the database.");
            }
            else
            {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
          //  $conn->close();

    ?>

    <?php include '../includes/footer.inc'; ?>
</body>
</html>

