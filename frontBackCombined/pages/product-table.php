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
                            <input type="checkbox" name="all" id="">
                        </th>
                        <th class="imageHeading">Image</th>
                        <th>ID</th>
                        <th class="nameHeading">Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th class="actionHeading">Actions</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="checkBox"><input type="checkbox" name="100000" id="10000" onclick="highlightProduct(this)"></td>
                        <td><img src="../image/product/100000.png" alt=""></td>
                        <td>100000</td>
                        <td>iPhone 14 Pro Max</td>
                        <td>$2000.00</td>
                        <td>Phone</td>
                        <td class="actions">
                            <form action="read-product.php" method="get">
                                <input type="hidden" name="productID" value="100000">
                                <button type="submit"><i class="fa-solid fa-eye"></i></button>
                            </form>
                            <form action="edit-product.php" method="get">
                                <input type="hidden" name="productID" value="100000">
                                <button type="submit"><i class="fa-solid fa-pen"></i></button>
                            </form>
                            <i class="fa-solid fa-trash" onclick="displayDeleteMessage()"></i>
                        </td>
                    </tr>
                    <tr>
                        <td class="checkBox"><input type="checkbox" name="100000" id="10000" onclick="highlightProduct(this)"></td>
                        <td><img src="../image/product/100000.png" alt=""></td>
                        <td>100000</td>
                        <td>iPhone 14 Pro Max</td>
                        <td>$2000.00</td>
                        <td>Phone</td>
                        <td class="actions delete-message">
                            <div class="question">
                                DELETE ?
                            </div>
                            <div class="choice">
                                <div class="yes-choice">
                                    <form action="delete-product.php" method="get">
                                        <input type="hidden" name="productID" value="100000">
                                        <button type="submit">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="no-choice">
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
         
                    
                </tbody>
            </table>
        </div>



    </section>

    <script src="../js/product.js"></script>       
    <script src="../js/sidebar.js"></script>    
</body>
</html>