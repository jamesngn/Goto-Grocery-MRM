<?php
    session_start();
    $product_id = $_SESSION['productID'];
    
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">EDIT Category</span>
        </div>
        <div class="reponse-container">
            <div class="info">
                <img class="success-icon" src="../image/success-icon.png" alt="success-check-icon">
                <div class="message-container">
                    <div class="big-message">
                        Edition Success
                    </div>
                    <div class="small-message">
                        Wait a few minutes while the information is validated
                    </div>
                </div>
            </div>
            <button id="addMoreButton" class="add" onclick="RedirectToEditCategoryPage(<?php echo $category_id; session_unset(); session_destroy(); ?>)">
                Edit Again
            </button>
            <button id = "closeButton" class="close" onclick="RedirectToCategoryPage()">
                Close
            </button>
        </div>

    </section>

<script src="../js/product.js"></script>       
<script src="../js/sidebar.js"></script>    
</body>
</html>