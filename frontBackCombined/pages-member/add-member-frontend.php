<?php
include '../includes/header.inc';
?>

<body>
    <?php include '../includes/sidebar.inc'; ?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">Add MEMEBER</span>
        </div>

        <div class="form-container">
            <div id="addMemberForm">
                <form action="add-member-validation.php" method="post">

                    <div class="backButton">
                        <a href="member.php">
                            <i class="fa-solid fa-delete-left"></i>
                            <span>Member Page</span>
                        </a>
                    </div>
                    <div class="text-input-container">
                        <div class="form-wrap">
                            <div class="form-item">
                                <label for="fname">First name</label>
                                <input type="text" name="fname" id="fname" pattern="^[A-Za-z-]+$" maxlength="50" required />
                            </div>
                        </div>
                        <div class="form-wrap">
                            <div class="form-item">
                                <label for="lname">Last name</label>
                                <input type="text" name="lname" id="lname" pattern="^[A-Za-z-]+$" maxlength="50" required />
                            </div>
                        </div>
                        <div class="form-wrap">
                            <div class="form-item">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" maxlength="50" required />
                            </div>
                        </div>
                        <div class="form-wrap">
                            <div class="form-item">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" maxlength="50" required />
                            </div>
                        </div>
                        <div class="form-wrap">
                            <button class="edit" type="submit" name="submit">Edit</button>
                            <button type="reset" onclick="ResetInput()">Reset</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </section>
    <script src="../js/member.js"></script>
    <script src="../js/sidebar.js"></script>
</body>

</html>