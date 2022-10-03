<?php
include '../includes/header.inc';
?>

<body>
    <?php include '../includes/sidebar.inc'; ?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">READ MEMEBER</span>
        </div>

        <div class="form-container">
            <div id="addProductForm">

                <div class="backButton">
                    <a href="product-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Member Page</span>
                    </a>
                </div>

                <?php
                require 'php-function/read-member.php';
                $member = readMember();
                $hasMember = hasMember($member);
                if ($hasMember) :
                ?>
                    <div class="text-input-container">
                        <div class="form-wrap">
                            <div class="form-item">
                                <label for="memberID">Member ID</label>
                                <input type="text" name="memberID" id="memberID" value="<?php echo $member['customer_id']; ?>" readonly>
                            </div>
                            <div class="form-item">
                                <label for="fName">First Name</label>
                                <input type="text" name="fName" id="fName" value="<?php echo $member['customer_firstname']; ?>" readonly>
                            </div>
                            <div class="form-item">
                                <label for="lName">Last Name</label>
                                <input type="text" name="lName" id="lName" value="<?php echo $member['customer_lastname']; ?>" readonly>
                            </div>
                            <div class="form-item">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="<?php echo $member['customer_email']; ?>" readonly>
                            </div>
                        </div>


                    </div>
                <?php endif; ?>

            </div>
        </div>

    </section>

    <script src="../js/sidebar.js"></script>
</body>

</html>