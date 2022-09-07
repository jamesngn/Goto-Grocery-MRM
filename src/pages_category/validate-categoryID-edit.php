<?php session_start();
include '../includes/header.inc'; 
?>

<body>
    <?php include '../includes/menu.inc';?>
    <h2>Validate category ID for editting</h2>

    <form action="validate-categoryID-edit.php" method="post">
        <fieldset>
            <legend>Enter the category ID</legend>
            <p>
                <label for="categoryID">Category ID:</label>
                <input type="text" name="categoryID" id="categoryID">
            </p>

            <p>
                <button type="submit">Search</button>
                <button type="reset">Reset</button>
            </p>
        </fieldset>
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
            //Connect to the database and store it in variable $conn.
            $conn = OpenConnection();
            //Clean the id value to prevent from attack.
            $category_id = mysqli_real_escape_string($conn, cleanInput($_POST['categoryID']));
            //select the row from the category table to match with the input id.
            $sql = "SELECT * FROM category WHERE CategoryID = $category_id";
            //perform a query against the database.
            $result = mysqli_query($conn, $sql);
            //validation check
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    echo nl2br("\r\n Error: Category ID $category_id is not found.");
                } else {
                    $_SESSION['ID'] = $category_id;
                    header("location:edit-category.php");
                }
            }
            else {
                echo nl2br("\r\nSQL error: " . mysqli_error($conn));
            }
            CloseConnection($conn);
        }

    ?>

    <?php include '../includes/footer.inc';?>
</body>