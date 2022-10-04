<?php    
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">EDIT PRODUCT</span>
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
            <button id="addMoreButton" class="add" onclick="RedirectToEditProductPage(sessionStorage.getItem('productID'))">
                Edit Again
            </button>
            <button id = "closeButton" class="close" onclick="RedirectToProductPage()">
                Close
            </button>
        </div>

    </section>

<script src="../js/product.js"></script>       
<script src="../js/sidebar.js"></script>    
</body>
</html>