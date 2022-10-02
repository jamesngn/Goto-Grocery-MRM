<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">PRODUCT TABLE</span>
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