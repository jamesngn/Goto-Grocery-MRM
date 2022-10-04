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


        <form action="read-product.php" method="get">
            <input type="hidden" name="productID" value="100000">
            <button type="submit">Read Product</button>
        </form>


    </section>

    <script src="../js/product.js"></script>       
    <script src="../js/sidebar.js"></script>    
</body>
</html>