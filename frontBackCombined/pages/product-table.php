<?php 
    include '../includes/header.inc';
?>

<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section tablePage">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">PRODUCT TABLE</span>
        </div>

        <div class="top-section">
            <div class="left-items">
                <div class="pageTitle">Product</div>
                <div class="search-bar">
                    <form action="product-table.php" method="get">
                        <input type="text" name="query" id="query" placeholder="Search Products">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
            <div class="right-items addProductButton">
                <a href="add-product.php">+ Add product</a>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                        <th class="checkBox">
                            <input type="checkbox" id="" onclick="highlightAll(this)">
                        </th>
                        <th class="imageHeading">Image</th>
                        <th>ID</th>
                        <th class="nameHeading">Name</th>
                        <th>Retail Price</th>
                        <th>Category</th>
                        <th class="actionHeading">Actions</th>
                </thead>
                <tbody>
                <?php 
                    include '../includes/dbAuthentication.inc';
                    $conn = OpenConnection();

                    $sql = "SELECT product.id as id, product.image as image, product.name as name, product.retailPrice as retailPrice, category.Name as category
                            FROM product
                            LEFT JOIN category
                            ON product.category_ID = category.CategoryID
                            ";
                    $result = mysqli_query($conn,$sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while($row = $result -> fetch_assoc()) { ?>
                            
                            <tr id="product<?php echo $row["id"];?>">
                                <td class="checkBox"><input type="checkbox" name="<?php echo $row["id"];?>" onclick="highlightProduct(this)"></td>
                                <td><img src="<?php echo $row["image"];?>" alt=""></td>
                                <td><?php echo $row["id"];?></td>
                                <td class="nameData"><?php echo $row["name"];?></td>
                                <td>$<?php echo number_format($row["retailPrice"],2);?></td>
                                <td><?php echo $row["category"];?></td>
                                <td class="actions">
                                    <form action="read-product.php" method="get">
                                        <input type="hidden" name="productID" value="<?php echo $row["id"];?>">
                                        <button type="submit"><i class="fa-solid fa-eye"></i></button>
                                    </form>
                                    <form action="edit-product.php" method="get">
                                        <input type="hidden" name="productID" value="<?php echo $row["id"];?>">
                                        <button type="submit"><i class="fa-solid fa-pen"></i></button>
                                    </form>
                                    <i class='fa-solid fa-trash' onclick='displayDeleteQuestion(this)' name = 'productID' value = '<?php echo $row["id"];?>'></i>
                                </td>
                            </tr>

                <?php
                            }
                        }
                    }
                    CloseConnection($conn);
                ?>
                
                </tbody>
            </table>
        </div>

    </section>

    <script src="../js/product.js"></script>       
    <script src="../js/sidebar.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</body>
</html>