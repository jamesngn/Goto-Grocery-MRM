<?php 
    session_start();
    if (!$_SESSION["errMsg"]) {
        header("location: add-sale.php");
    } 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">ADD NEW SALE</span>
        </div>
        <div class="reponse-container">
            <div class="info">
                <img class="fail-icon" src="../image/fail-icon.png" alt="fail-cross-icon">
                <div class="message-container">
                    <div class="big-message">
                        Addition fail
                    </div>
                    <div class="small-message">
                        <?php 
                            echo $_SESSION["errMsg"];
                            session_unset();
                            session_destroy();    
                        ?>
                    </div>
                </div>
            </div>
            <button id="addMoreButton" class="add" onclick="RedirectToAddSalePage()">
                Add Again
            </button>
            <button id = "closeButton" class="close" onclick="RedirectToSalePage()">
                Close
            </button>
        </div>

    </section>

<script src="../js/sale.js"></script>       
<script src="../js/sidebar.js"></script>    
</body>
</html>