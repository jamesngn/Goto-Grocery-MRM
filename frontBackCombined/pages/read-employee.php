<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 

       

        $ID = $_GET["employee_ID"];
        if ($ID) {
            include '../includes/dbAuthentication.inc';
            $conn = OpenConnection();
    
            $sql = "SELECT * FROM employee WHERE employee_ID = '$ID'";
            $result = mysqli_query($conn,$sql);
    
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $ID = mysqli_fetch_assoc($result);   
                               
                }
            }
            else {
                echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
            }
    
            

        }


    }
    ?>

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
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Employee Page</span>
                    </a>
                </div>

                        <div class="text-input-container">
                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="fname">First Name</label>
                                    <input type="text" name="fname" id="fname" value="<?php echo $ID['fname']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="memberID">Employee ID</label>
                                    <input type="text" name="memberID" id="memberID" value="<?php echo $ID['employee_ID']; ?>" readonly>
                                </div>

                            </div>
                            <div class="form-wrap">
                                <div class="form-item">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="<?php echo $ID['email']; ?>" readonly>
                                </div>
                            </div>
                        </div>


            </div>

    <?php 
                
    ?>

        </div>
        </div>

    </section>

    <script src="../js/sidebar.js"></script>
</body>

</html>