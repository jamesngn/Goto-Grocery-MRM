<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">ADD NEW PRODUCT</span>
        </div>
        <div class="reponse-container">
            <div class="info">
                <img class="fail-icon" src="../image/fail-icon.png" alt="fail-cross-icon">
                <div class="message-container">
                    <div class="big-message">
                        Addition fail
                    </div>
                    <div class="small-message">
                        Error Message!
                    </div>
                </div>
            </div>
            <button id="addMoreButton" class="add" onclick="RedirectToAddProductPage()">
                Add Again
            </button>
            <button id = "closeButton" class="close" onclick="RedirectToProductPage()">
                Close
            </button>
        </div>

    </section>

<script src="../js/product.js"></script>        
</body>
</html>