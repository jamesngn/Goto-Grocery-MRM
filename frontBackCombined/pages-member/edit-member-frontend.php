<?php
include '../includes/header.inc';
?>

<body>
    <?php include '../includes/sidebar.inc'; ?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">Edit MEMEBER</span>
        </div>

        <div class="form-container">
            <div id="addProductForm">
                <form action="edit-member-sucess.php" method="post">

                    <div class="backButton">
                        <a href="member.php">
                            <i class="fa-solid fa-delete-left"></i>
                            <span>Member Page</span>
                        </a>
                    </div>

                    <?php
                    require 'php-function/edit-member.php';


                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $existmemberID = $_POST["checkmemberID"];
                        $member = readMember($existmemberID);


                        $hasMember = hasMember($member);
                        if ($hasMember) {
                    ?>
                            <div class="text-input-container">
                                <div class="form-wrap">
                                    <div class="form-item">
                                        <label for="fname">First name</label>
                                        <input type="text" name="fname" id="fname" pattern="^[A-Za-z-]+$" maxlength="50" required value="<?php echo $member['customer_firstname']; ?>" />
                                    </div>
                                </div>
                                <div class="form-wrap">
                                    <div class="form-item">
                                        <label for="lname">Last name</label>
                                        <input type="text" name="lname" id="lname" pattern="^[A-Za-z-]+$" maxlength="50" required value="<?php echo $member['customer_lastname']; ?>" />
                                    </div>
                                </div>
                                <div class="form-wrap">
                                    <div class="form-item">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" maxlength="50" required value="<?php echo $member['customer_email']; ?>">
                                    </div>
                                </div>
                                <div class="form-wrap">
                                    <input type="hidden" name="existmemberID" id="existmemberID" value="<?php echo $member['customer_id']; ?>">
                                    <button class="edit" type="submit" name="submit">Edit</button>
                                    <button type="reset" onclick="ResetInput()">Reset</button>
                                </div>

                            </div>

                    <?php }
                    } ?>
                </form>

            </div>
        </div>
    </section>
    <script src="../js/member.js"></script>
    <script src="../js/sidebar.js"></script>
</body>

</html>