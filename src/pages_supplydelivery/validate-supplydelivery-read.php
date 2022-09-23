<?php include '../includes/header.inc';
session_start();
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate Supply Delivery for reading </h2>

    <form method="post" action="validate-supplydelivery-read.php">
        <fieldset>
            <legend>Enter Supply Delivery details</legend>
            <p>
                <label for="supplydeliveryid">Enter supply delivery id</label>
                <input type="text" name="supplydeliveryid" id="supplydeliveryid" pattern="\d{1,10}" maxlength="10" required />
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
            $suppdel_id = mysqli_real_escape_string($conn, cleanInput($_POST["suppdelivery"]));
            // check to the database
            $result =mysqli_query($conn, $sql);
            $sql = "SELECT * FROM suppdelivery WHERE supplydeliveryid = '$suppdel_id' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)==0)
                {
                    echo nl2br("\r\n Error:Check ID is correct.");

                }
                else{
                    //echo nl2br("\r\n wishlist with $c_wishlistID is found on the database.");
                    //echo nl2br("\r\n Do you wish to proceed with this ID  $c_wishlistID.");
                    $_SESSION["supplydeliveryid"] =$suppdel_id;
                    header ("location: read-supply-delivery.php");
            
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

</html>