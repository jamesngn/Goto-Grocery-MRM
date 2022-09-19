<?php
include '../php/time-page.php';
$startpage = StartTime();
session_start(); 
include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Sucess: Add a Member</h2>

    <?php
        $c_firstname = $_SESSION["firstname"];
        $c_lastname = $_SESSION["lastname"];
        echo nl2br("\r\n Added customer $c_firstname $c_lastname to the database.");
    ?>
    <?php include '../includes/footer.inc'; ?>
    <?php include '../includes/bootstrapcore.inc'; ?>
</body>
<!--Author:THANH NGUYEN  Hello DATE:19/09/2022-->
</html>
<?php
$display_page_time = StopTime($startpage);
echo $display_page_time;
?>
