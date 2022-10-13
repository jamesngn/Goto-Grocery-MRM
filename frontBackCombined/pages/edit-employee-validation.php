<body>
    <?php
    require 'edit-employee.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $employeeID = $_POST["employeeID"];
        $check = editEmployee($fname, $lname, $email, $employeeID);
        if ($check == true) {
    ?>
            <?php include '../includes/header.inc'; ?>
            <?php include '../includes/sidebar.inc'; ?>
            <section class="home-section">
                <div class="top-bar">
                    <i class="fas fa-solid fa-bars"></i>
                    <span class="title">EDIT EMPLOYEE</span>
                </div>
                <div class="reponse-container">
                    <div class="info">
                        <img class="success-icon" src="../image/success-icon.png" alt="success-check-icon">
                        <div class="message-container">
                            <div class="big-message">
                                Edition Success
                            </div>
                        </div>
                    </div>
                    <form method="post" action="edit-employee-frontend.php">
                        <p>
                            <input type="hidden" name="checkemployeeID" id="checkemployeeID" value="<?php echo $employeeID; ?>">
                        </p>
                        <button id=" addMoreButton" class="add">
                            Edit Again
                        </button>
                    </form>
                    <a href="employee.php">
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
                <span class="title">Edit EMPLOYEE</span>
            </div>
            <div class="reponse-container">
            <div class="info">
                <img class="fail-icon" src="../image/fail-icon.png" alt="fail-cross-icon">
                <div class="message-container">
                    <div class="big-message">
                        Edit fail
                    </div>
                    <div class="small-message">
                        Error Message!
                    </div>
                </div>
            </div>
            <form method="post" action="edit-employee-frontend.php">
                        <p>
                            <input type="hidden" name="checkemployeeID" id="checkemployeeID" value="<?php echo $employeeID; ?>">
                        </p>
                        <button id=" addMoreButton" class="add">
                            Edit Again
                        </button>
                    </form>
                <a href="employee.php">
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