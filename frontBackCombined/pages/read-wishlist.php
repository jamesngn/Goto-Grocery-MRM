<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 

       

        $wishlistid = $_GET["wishlistid"];
        if ($wishlistid) {
            include '../includes/dbAuthentication.inc';
            $conn = OpenConnection();
    
            $sql = "SELECT * FROM wishlist WHERE wishlistid = '$wishlistid'";
            $result = mysqli_query($conn,$sql);
    
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $wishlist = mysqli_fetch_assoc($result);   
                               
                }
            }
            else {
                echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
            }
    
            

        }


    }
?>

<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">READ WISHLIST</span>
        </div>

        <div class="form-container">
            <div id="addProductForm">

                <div class="backButton">
                    <a href="wishlist-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Wishlist Page</span>
                    </a>
                </div>
                
                
                
                <div class="text-input-container">
                   
                        <div class="form-item">
                            <label for="wishlistid">Wishlist ID</label>
                            <input type="text" name="wishlistid" id="wishlistid" value="<?php echo $wishlist['wishlistid'];?>" readonly>
                        </div>
                        <div class="form-item">
                            <label for="cust_id">Customer ID</label>
                            <input type="text" name="cust_id" id="cust_id" value="<?php echo $wishlist['cust_id'];?>" readonly>
                        </div>
                        <div class="form-item">
                            <label for="prod_id">Product ID</label>
                            <input type="text" name="prod_id" id="prod_id" value="<?php echo $wishlist['prod_id'];?>" readonly>
                        </div>

                    

                    

               
            </div>
        </div>

    </section>
    
    <script src="../js/sidebar.js"></script>    
</body>
</html>