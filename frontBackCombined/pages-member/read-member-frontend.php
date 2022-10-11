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
            <div id="addMemberForm">

                <div class="backButton">
                    <a href="member.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Member Page</span>
                    </a>
                </div>

                <?php
                require 'php-function/read-member.php';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $existmemberID = $_POST["checkmemberID"];
                    $member = readMember($existmemberID);


                    $hasMember = hasMember($member);
                    if ($hasMember) {
                        $fname = $member['customer_firstname'];
                        $lname = $member['customer_lastname'];
                        $fullname = "${fname} ${lname}";
                ?>
                        <div class="text-input-container">
                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="cName">First Name</label>
                                    <input type="text" name="cName" id="cName" value="<?php echo $fullname; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="memberID">Member ID</label>
                                    <input type="text" name="memberID" id="memberID" value="<?php echo $member['customer_id']; ?>" readonly>
                                </div>

                            </div>
                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="<?php echo $member['customer_email']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="created_date">Date Joined</label>
                                    <input type="text" name="created_date" id="created_date" value="<?php echo $member['CREATED_AT']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-container">
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