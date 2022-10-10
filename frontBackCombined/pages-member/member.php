<?php
include '../includes/header.inc';
include 'php-function/read-member.php'
?>

<body>
    <?php include '../includes/sidebar.inc'; ?>;
    <section class="home-section tablePage">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">Display MEMEBER</span>
        </div>

        <div class="top-section">
            <div class="left-items">
                <div class="pageTitle">Member</div>
                <div class="search-bar">
                    <form action="member-table.php" method="get">
                        <input type="text" name="query" id="query" placeholder="Search Member">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
            <div class="right-items addProductButton">
                <a href="add-member-frontend.php">+ Add Member</a>
            </div>
        </div>


        <?php
        $testColumn = getAllMemberColumn();
        ?>
        <div class="table-container">
            <table >
                <thead>
                    <tr>
                        <th class="checkBox">
                            <input type="checkbox" id="" onclick="highlightAll(this)">
                        </th>
                        <?php

                        for ($i = 0; $i <= sizeof($testColumn) - 1; $i++) {
                            echo "<th>$testColumn[$i]</th>";
                        }

                        ?>
                        <th class="actionHeading">Actions</th>
                </thead>
                <?php //$testRow = getAllMemberRow(); ?>
                <tbody>
                <?php 
                    require_once 'php-function/dbAuthentication.php';
                    $conn = OpenConnection();
                    $num_per_page = 8;
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
            
                        
                    }
                    else {
                        $page = 1;
                    }
                    
                    $start_from = ($page - 1) * $num_per_page;

                    $sql = "SELECT 
                     member.customer_id as customer_id, 
                     member.customer_firstname as customer_firstname,
                     member.customer_lastname as customer_lastname, 
                     member.customer_email as customer_email, 
                     member.customer_password as customer_password, 
                     member.CREATED_AT as CREATED_AT
                            FROM member
                            LIMIT $start_from,$num_per_page 
                            ";
                    $testRow = mysqli_query($conn,$sql);
                    ?>

                    <?php
                    while ($rows = $testRow->fetch_assoc()) { ?>
                        <tr class="member" id="member<?php echo $rows["customer_id"]; ?>" value="<?php echo $page; ?>">
                            <td class="checkBox"><input type="checkbox" name="<?php echo $rows["customer_id"]; ?>" onclick="highlightProduct(this)"></td>
                            <?php foreach ($testColumn as $column) { ?>


                                <td>
                                    <?php echo $rows[$column]; ?>
                                </td>
                              

                            <?php } ?> 
                            <td class="actions">
                            <input type="hidden" name="existmemberID" id="existmemberID" value='<?php echo $rows["customer_id"]; ?>' />
                                <form method="post" action="read-member-frontend.php">
                                    <input type="hidden"  name="checkmemberID" id="checkmemberID" value='<?php echo $rows["customer_id"]; ?>'  />
                                    <button type="submit" ><i class="fa-solid fa-eye"></i></button>
                                </form>
                                <form method="post" action="edit-member-frontend.php">
                                    <input type="hidden" name="checkmemberID" id="checkmemberID" value='<?php echo $rows["customer_id"]; ?>'  />
                                    <button type="submit"><i class="fa-solid fa-pen"></i></button>
                                </form>
                                <i class='fa-solid fa-trash' onclick='displayDeleteQuestion(this)' name='memberID' value='<?php echo $rows["customer_id"]; ?>'></i>
                            </td>
                        </tr>
                    <?php   }



                    ?>

                </tbody>
            </table>
        </div>
        <div class="pageNumbers-container">
             
            
            <?php
                $sql = "SELECT * FROM member";
                $result = mysqli_query($conn, $sql);
                $total_members = mysqli_num_rows($result);

                $total_pages = ceil($total_members/$num_per_page);
                
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
    <script src="../js/member.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>

</html>