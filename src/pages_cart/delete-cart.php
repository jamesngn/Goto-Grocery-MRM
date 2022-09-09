<?php 
    session_start();

    $c_member_ID = $_SESSION["member-id"];

    
    include '../includes/dbAuthentication.inc';
    $conn = openConnection();

    // retrieve cart info FROM cart based on memberID 
    $sql = "SELECT productID, product.name as productName
            FROM cart 
            LEFT JOIN product
            ON product.id = cart.productID
            WHERE memberID = '$c_member_ID'";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $addedCartItems = mysqli_fetch_all($result,MYSQLI_ASSOC);
    } else {
        echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
    }
    
    mysqli_free_result($result);

?>

<?php 
    
    include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Hi <?php echo $c_member_ID;?>, please choose items in your shopping cart to delete !</h2>
    <form action="delete-cart.php" method="post">  
        
        <?php foreach ($addedCartItems as $addedCartItem): ?>
            <p>
                <label for="<?php echo $addedCartItem['productID'] ;?>"><?php echo $addedCartItem['productName'];?></label> 
                <input type="checkbox" name="<?php echo $addedCartItem['productID'] ;?>" id="<?php echo $addedCartItem['productID'] ;?>">
            </p>

        <?php endforeach;?>    
       
    </form>

    <?php
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            
            foreach ($addedCartItems as $addedCartItem) {
                if ($_POST[$addedCartItem['productID']] == "checked") {
                    $deleteIDs['id'] = $addedCartItem['productID'];
                }
            }

            foreach ($deleteIDs as $key => $deleteID) {
                $sql2 = "DELETE FROM car WHERE productID = '$deleteID'";
                $result = mysqli_query($conn,$sql2);
                if ($result) {
                    echo "<h5>The product ID $deletedID is successully deleted.h5>";
                } else {
                    echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
                }
            }



            session_unset();
            session_destroy();
        }
        
        mysqli_free_result($result);
        CloseConnection($conn);
    ?>

    </body>
</html>

