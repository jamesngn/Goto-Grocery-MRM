<?php 
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 
        $suppid = $_GET["supplier_id"];
    } else {
        $suppid = $_POST["supplier_id"];
    }
   
   echo $suppid;
   
   if ($suppid) {
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "SELECT * FROM supplier WHERE supplier_id = '$suppid'";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $supplier = mysqli_fetch_assoc($result);
                print_r($supplier);
            }
        }
    }
        // else {
        //     echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
        // }

       

    
?>

<?php 
    include '../includes/header.inc';
    
?>
<body>
<?php include '../includes/sidebar.inc';?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">EDIT SUPPLIER</span>
        </div>

        <div class="form-container">
            <form action="edit-supplier.php?supplier_id=<?php echo $suppid;?>" method="post"  id="addProductForm">
                <div class="backButton">
                    <a href="supplier-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Supplier Page</span>
                    </a>
                </div>
                

                
                <div class="text-input-container">
                    <div>
                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="supplier_id">Supplier ID</label>
                            <input type="text" name="supplier_id" id="supplier_id" value="<?php echo $supplier['supplier_id'];?>" readonly>
                        </div>    
                    </div>

                        <div class="form-item">
                            <label for="supplier_name">Supplier Name</label>
                            <input type="text" name="supplier_name" id="supplier_name" value="<?php echo $supplier['supplier_name'];?>" required>
                        </div>
                    </div>

                  

                    

                    <div class="form-wrap">
                        <button class="edit" type="submit" name="submit">Edit</button>
                        <button type="reset" onclick="ResetInput()">Reset</button>
                    </div>
                </div>

                
                
            </form>
        </div>

    </section>
    <script src="../js/product.js"></script>  
    <script src="../js/sidebar.js"></script>    
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

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        

        // the cleaned – "safe" – inputs ready to be added to the database
        $suppname = mysqli_real_escape_string($conn, cleanInput($_POST['supplier_name']));
       
    
        //Add to database
        $sql = "UPDATE supplier
        SET supplier_name = '$suppname'
        WHERE supplier_id = '$suppid'";

        if (mysqli_query($conn,$sql)) {
            $_SESSION['supplier_id'] = $suppid;
            echo "<script>sessionStorage.setItem('supplier_id',".$suppid.");</script>";
            echo '<script>window.location.href = "edit-supplier-success.php"; </script>';
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
