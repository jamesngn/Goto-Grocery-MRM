<?php 
    include '../includes/header.inc';
?>

<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section tablePage">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">CATEGORY TABLE</span>
        </div>

        <div class="top-section">
            <div class="left-items">
                <div class="pageTitle">Category</div>
                <div class="search-bar">
                    <form action="category-table.php" method="get">
                        <input type="text" name="query" id="query" placeholder="Search Categories">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
            <div class="right-items addProductButton">
                <a href="add-category.php">+ Add Category</a>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                        <th class="checkBox">
                            <input type="checkbox" id="" onclick="highlightAll(this)">
                        </th>
                       
                        <th>ID</th>
                        <th class="nameHeading">Name</th>
                        
                        <th class="actionHeading">Actions</th>
                </thead>
                <tbody>
                <?php 
                    include '../includes/dbAuthentication.inc';
                    $conn = OpenConnection();

                    $num_per_page = 10;

                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                    }
                    else {
                        $page = 1;
                    }

                    $start_from = ($page - 1) * $num_per_page;

                    $sql = "SELECT category.CategoryID as CategoryID, category.Name as Name
                            FROM category
                           
                            LIMIT $start_from,$num_per_page
                            ";
                    $result = mysqli_query($conn,$sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while($row = $result -> fetch_assoc()) { ?>
                            
                            <tr id="category<?php echo $row["CategoryID"];?>" value="<?php echo $page; ?>">
                                <td class="checkBox"><input type="checkbox" name="<?php echo $row["CategoryID"];?>" onclick="highlightCategory(this)"></td>
                                
                                <td><?php echo $row["CategoryID"];?></td>
                                <td class="nameData"><?php echo $row["Name"];?></td>
                               
                               
                                <td class="actions">
                                    <form action="read-category.php" method="get">
                                        <input type="hidden" name="CategoryID" value="<?php echo $row["CategoryID"];?>">
                                        <button type="submit"><i class="fa-solid fa-eye"></i></button>
                                    </form>
                                    <form action="edit-category.php" method="get">
                                        <input type="hidden" name="CategoryID" value="<?php echo $row["CategoryID"];?>">
                                        <button type="submit"><i class="fa-solid fa-pen"></i></button>
                                    </form>
                                    <i class='fa-solid fa-trash' onclick='displayDeleteQuestion(this)' name = 'CategoryID' value = '<?php echo $row["CategoryID"];?>'></i>
                                </td>
                            </tr>

                <?php
                            }
                        }
                    }

                    
                ?>
                
                </tbody>
            </table>
        </div>

        <div class="pageNumbers-container">
             
            
            <?php
                $sql = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql);
                $total_categories = mysqli_num_rows($result);
                $total_pages = ceil($total_categories/$num_per_page);
                
                echo '<button class="previous-btn" onClick="goToPage('.($page-1).','.$total_pages.')">Previous</button>';

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($page == $i) {
                        echo '<button class="pageNumber active">'.$i.'</button>';
                    } else {
                        echo '<button class="pageNumber" onClick="goToPage('.$i.','.$total_pages.')">'.$i.'</button>';
                    }
                }

                echo '<button class="next-btn" onClick="goToPage('.($page+1).','.$total_pages.')">Next</button>';
                CloseConnection($conn);
            ?>
        </div>

    </section>

    <script src="../js/category.js"></script>       
    <script src="../js/sidebar.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</body>
</html>