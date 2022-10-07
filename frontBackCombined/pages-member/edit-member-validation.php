<body>
    <?php
    require 'php-function/edit-member.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $c_fname = $_POST["fname"];
        $c_lname = $_POST["lname"];
        $c_email = $_POST["email"];
        $c_memberID = $_POST["existmemberID"];
        $check = editMember($c_fname, $c_lname, $c_email, $c_memberID);
        if ($check == true) {
    ?>
            <?php include '../includes/header.inc'; ?>
            <?php include '../includes/sidebar.inc'; ?>
            <section class="home-section">
                <div class="top-bar">
                    <i class="fas fa-solid fa-bars"></i>
                    <span class="title">EDIT MEMEBER</span>
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
                    <form method="post" action="edit-member-frontend.php">
                        <p>
                            <input type="hidden" name="existmemberID" id="existmemberID" value="<?php echo $c_memberID; ?>">
                        </p>
                        <button id=" addMoreButton" class="add">
                            Edit Again
                        </button>
                    </form>
                    <a href="member.php">
                    <button id="closeButton" class="close">
                        Close
                    </button>
                </div>

            </section>

            <script src="../js/product.js"></script>
            <script src="../js/sidebar.js"></script>
</body>

</html>
<?php
        }
    } else {
        header('location: edit-member-failure');
    }
?>