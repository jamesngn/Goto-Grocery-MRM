 <?php
include '../includes/header.inc';
?>

<body>
    <?php include '../includes/sidebar.inc'; ?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">READ Employee</span>
        </div>

        <div class="form-container">
            <div id="addProductForm">

                <div class="backButton">
                <a href="employee.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Employee Page</span>
                    </a>
                </div>
                <?php
                require 'read-employee.php';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $employeeID = $_POST["checkemployeeID"];
                    $employee = readEmployee($employeeID);


                    $hasEmployee = hasEmployee($employee);
                    if ($hasEmployee) {
                        $fname = $employee['fname'];
                        $lname = $employee['lname'];
                        $fullname = "${fname} ${lname}";
                ?>

                        <div class="text-input-container">
                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="fname">Full Name</label>
                                    <input type="text" name="fname" id="fname" value="<?php echo $fullname; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="memberID">Employee ID</label>
                                    <input type="text" name="memberID" id="memberID" value="<?php echo $employee['employee_ID']; ?>" readonly>
                                </div>

                            </div>
                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="<?php echo $employee['email']; ?>" readonly>
                                </div>
                            </div>
                        </div>
            </div>

            <?php }
                }
    ?>

        </div>
        </div>

    </section>

    <script src="../js/sidebar.js"></script>
</body>

</html>