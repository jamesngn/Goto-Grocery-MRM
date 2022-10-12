<?php 
    session_start();
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;

    <?php 
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "SELECT customer_id, customer_firstname, customer_lastname FROM member";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $members = mysqli_fetch_all($result);
        }

        $sql = "SELECT id, name, retailPrice FROM product";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            $products = mysqli_fetch_all($result);
        }
        

        CloseConnection($conn);
        
    ?>

    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">ADD NEW SALE</span>
        </div>

        <div class="form-container salePage">
            <form action="add-sale.php" method="post" id="addSaleForm">
                <div class="backButton">
                    <a href="sale-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Sale Page</span>
                    </a>
                </div>

                <div class="member-section">
                    <div>
                        <label for = "memberID">MEMBER</label>
                        <div class="select-container">
                            <select name="memberID" id="members">
                                <option value="">Please choose a member</option>
                                <?php foreach($members as $member) : ?>
                                    <option value="<?php echo $member[0];?>"><?php echo $member[1].' '.$member[2]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="sale-section" id="sale-section">
                    <div class="heading">PURCHASE PRODUCTS</div>
                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="productID1">Product</label>
                            <select name="productID1" id="product" onchange="updatePrice(this)">
                                <option value="">Choose a product</option>
                                <?php foreach($products as $product): ?>
                                    <option value="<?php echo $product[0].','.$product[2];?>"><?php echo $product[1]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-item">
                            <label for="price1">Retail Price</label>
                            <input type="text" name="price1" id="price" value="" readonly>
                        </div>
                        <div class="form-item">
                            <label for="quantity1">Quantity</label>
                            <input type="number" name="quantity1" id="quantity" min="0" max="99999" value="0" onchange="calculateSubtotal(this)" onkeyup="calculateSubtotal(this)">
                        </div>
                        <div class="form-item">
                            <label for="subtotal1">Subtotal</label>
                            <input type="text" name="subtotal1" id="subtotal" value="" readonly>
                        </div>
                    </div>
                    
                    <div class="add-new-product-section" onclick="addNewProduct(this)" value="2">
                        <input type="hidden" name="ItemNo" value="1">
                        <i class="fa-solid fa-circle-plus"></i>
                        <div class="content">Add another product</div>
                    </div>
                </div>
                
                
                <div class="button-container">
                    <button class="add" type="submit" name="submit">Add</button>
                    <button type="reset">Reset</button>
                </div>
            </form>
            
        </div>

    </section>

    <script src="../js/sale.js"></script>    
    <script src="../js/sidebar.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
   
</body>
</html>


<?php 

    function cleanInput($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function isInArray($compared, $array) {
        if ($array != null) {
            foreach($array as $id => $quantity) {
                if ($compared == $id) {
                    return true;
                }
            }
        }
        return false;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $errMsg = "";
        if ($_POST['memberID'] == "") {
            $errMsg.="Member cannot be empty\n";
        }

        for ($i = 1; $i <= $_POST['ItemNo']; $i++) {
            if ($_POST['productID'.$i] == "") {
                $errMsg.="Product cannot be empty\n";
            }
            if ($_POST['quantity'.$i] == 0) {
                $errMsg.="Quantity cannot be 0\n";
            }
        }
        
        if ($errMsg != "") {
            $_SESSION["errMsg"] = $errMsg;
            echo '<script>window.location.href = "add-sale-fail.php"; </script>';
        }
        else {
            $chosenProduct = [];
            for ($i = 1; $i <= $_POST['ItemNo']; $i++) {
                $pos = strpos($_POST['productID'.$i],",");
                $productID = substr($_POST['productID'.$i],0,$pos);

                if (!isInArray($productID,$chosenProduct)) {
                    $chosenProduct[$productID] = intval($_POST['quantity'.$i]);
                } else {
                    $chosenProduct[$productID] = $chosenProduct[$productID] + intval($_POST['quantity'.$i],10);
                }
            }

            print_r($chosenProduct);

            $conn = OpenConnection();
            
            $memberID = $_POST['memberID'];
            $sql = "INSERT INTO sale (memberID) VALUES ('$memberID')";
            $result = mysqli_query($conn,$sql);

            $sql = "SELECT max(saleID) as recentSaleID FROM sale";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $saleID = mysqli_fetch_row($result)[0];
                }
            }

            $lineNo = 1;
            foreach($chosenProduct as $productID => $quantity) {
                $sql = "INSERT INTO saleitem (saleID,lineNo,productID,quantity) VALUES ($saleID, $lineNo, $productID, $quantity)";
                $result = mysqli_query($conn,$sql);
                $lineNo++;
            }

            echo '<script>window.location.href = "add-sale-success.php"; </script>';

            CloseConnection($conn);
        }        
    }
?>
