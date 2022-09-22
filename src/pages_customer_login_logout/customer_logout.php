<html lang="en">
<?php
include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <?php  
session_start();  
session_destroy();  
header("Location: customer_login.php");//For redirection  
?>  

</body>
</html>