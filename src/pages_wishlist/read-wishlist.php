<?php include '../includes/header.inc';
session_start();
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Read Wishlist</h2>

    <form method="post" action="read_new_wishlist.php">
        <fieldset>
            <legend>Enter new wishlist details</legend>
            <p>
                <label for="wishlistid">Enter Wishlist ID</label>
                <input type="text" name="wishlistid" id="wishlistid" pattern="\d{1,10}" maxlength="10" required />
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
        
       if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $conn = OpenConnection();

         
          
            $result =mysqli_query($conn, $sql);
            $sql = "SELECT * FROM wishlist WHERE wishlistid = '$wishid' ";
            if(mysqli_query($conn, $sql))
            {
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)==0)
                {
                    echo nl2br("\r\n Error:Check ID is correct.");

                }
                else{
                 
                    $_SESSION["wishlistid"] =$wishid;
                    header ("location: read_new_wishlist.php");
            
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