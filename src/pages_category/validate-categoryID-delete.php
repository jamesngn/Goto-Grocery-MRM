<?php 
    session_start();
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Validate category ID for deleting</h2>
    <form action="validate-categoryID-delete.php" method="post">
        <p>
            <label for="categoryID">Category ID:</label>
            <input type="text" name="categoryID" id="categoryID">
        </p>
        <button type="submit">Delete</button>
    </form>

    <?php
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        include '../includes/dbAuthentication.inc';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $conn = OpenConnection();
            $category_id = mysqli_real_escape_string($conn,cleanInput($_POST['categoryID']));

            $sql = "SELECT * FROM category WHERE categoryID = '$category_id'";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Category ID $category_id is not found.");
                } else {
                    $_SESSION['categoryID'] = $category_id;
                    header("location: delete-category.php");
                }
            } else {
                echo nl2br("\r\n SQL Error: " . mysqli_error($conn));
            }
        }
        CloseConnection($conn);
    ?>
</body>