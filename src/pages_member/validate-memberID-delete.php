<?php include '../includes/header.inc';
session_start();
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate memeber ID for deleting </h2>

    <form method="post" action="validate-memberID-delete.php">
        <fieldset>
            <legend>Enter Member ID</legend>
            <p>
                <label for="memberID">Enter memberID</label>
                <input type="text" name="memberID" id="memberID" pattern="\d{1,10}" maxlength="10" required />
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
            $c_memberID = mysqli_real_escape_string($conn, cleanInput($_POST["memberID"]));
            // check to the database
            $result =mysqli_query($conn, $sql);
            $sql = "SELECT * FROM member WHERE customer_id = '$c_memberID' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)==0)
                {
                    echo nl2br("\r\n Error:Check ID is correct.");

                }
                else{
                    //echo nl2br("\r\n Customer with $c_memberID is found on the database.");
                    //echo nl2br("\r\n Do you wish to proceed with this ID  $c_memberID.");
                    $_SESSION["memberID"] =$c_memberID;
                    header ("location: delete-member.php");
            
                }
                
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
    <?php include '../includes/bootstrapcore.inc'; ?>
</body>
<!--Author:THANH NGUYEN DATE:05/09/2022-->
</html>