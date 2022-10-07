<body>
    <?php
    require 'php-function/add-member.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $c_fname = $_POST["fname"];
        $c_lname = $_POST["lname"];
        $c_email = $_POST["email"];
        $c_password = $_POST["password"];
        $check = addMember($c_fname, $c_lname, $c_email, $c_password);
        if ($check == true) {
    ?>
            <?php include '../includes/header.inc'; ?>
            <?php include '../includes/sidebar.inc'; ?>
            <section class="home-section">
                <div class="top-bar">
                    <i class="fas fa-solid fa-bars"></i>
                    <span class="title">Add MEMEBER</span>
                </div>
                <div class="reponse-container">
                    <div class="info">
                        <img class="success-icon" src="../image/success-icon.png" alt="success-check-icon">
                        <div class="message-container">
                            <div class="big-message">
                                Add Member Success
                            </div>
                            <div class="small-message">
                                Wait a few minutes while the information is validated
                            </div>
                        </div>
                    </div>
                    <a href="add-member-frontend.php">
                    <button id=" addMoreButton" class="add">
                        Add More
                    </button>
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
        }else { ?>
        <?php include '../includes/header.inc'; ?>
        <?php include '../includes/sidebar.inc'; ?>
        <section class="home-section">
            <div class="top-bar">
                <i class="fas fa-solid fa-bars"></i>
                <span class="title">Add MEMEBER</span>
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
                <a href="add-member-frontend.php">
                <button id=" addMoreButton" class="add">
                    Add More
                </button>
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
   <?php } ?>
<?php } ?>