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

                    $num_per_page = 3;

                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                    }
                    else {
                        $page = 1;
                    }

                    $start_from = ($page - 1) * $num_per_page;

                    $sql = "SELECT product.id as id, product.image as image, product.name as name, product.retailPrice as retailPrice, category.Name as category
                            FROM product
                            LEFT JOIN category
                            ON product.category_ID = category.CategoryID
                            LIMIT $start_from,$num_per_page
                            ";
                    $result = mysqli_query($conn,$sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while($row = $result -> fetch_assoc()) { ?>
                            
                            <tr id="product<?php echo $row["id"];?>" value="<?php echo $page; ?>">
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

                    
                ?>
                
                </tbody>
            </table>
        </div>

        <div class="pageNumbers-container">
             
            
            <?php
                $sql = "SELECT * FROM product";
                $result = mysqli_query($conn, $sql);
                $total_products = mysqli_num_rows($result);
                $total_pages = ceil($total_products/$num_per_page);
                
                echo '<button class="previous-btn" onClick="goToPage('.($page-1).','.$total_pages.')">Previous</button>';

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($page == $i) {
                        echo '<button class="pageNumber active">'.$i.'</button>';
                    } else {
                        echo '<button class="pageNumber" onClick="goToPage('.$i.','.$total_pages.')">'.$i.'</button>';
                    }
                }

                echo '<button class="next-btn" onClick="goToPage('.($page+1).','.$total_pages.')">Next</button>';
                CloseConnection($conn);
            ?>
        </div>

    </section>

    <script src="../js/product.js"></script>       
    <script src="../js/sidebar.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</body>
</html>