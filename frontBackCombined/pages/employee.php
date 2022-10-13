<?php
include '../includes/header.inc';
include 'read-employee.php'
?>

<body>
    <?php include '../includes/sidebar.inc'; ?>;
    <section class="home-section tablePage">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">Display Employee</span>
        </div>

        <div class="top-section">
            <div class="left-items">
                <div class="pagetitle">EMPLOYEE</div>
                <div class="search-bar">
                    <form action="employee.php" method="get">
                        <input type="text" name="query" id="query" placeholder="Search Employee">
                       </form>
                </div>
            </div>
            <div class="right-items addProductButton">
                <a href="add-employee-frontend.php">+ Add Employee</a>
            </div>
        </div>


        <?php
        $testColumn = getAllEmployeeColumn();
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
                    require_once '../includes/dbAuthentication.inc';
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
                     employee.employee_ID as employee_ID, 
                     employee.fname as fname,
                     employee.lname as lname, 
                     employee.email as email, 
                     employee.password as password
                            FROM employee
                            LIMIT $start_from,$num_per_page 
                            ";
                    $testRow = mysqli_query($conn,$sql);
                    ?>

                    <?php
                    while ($rows = $testRow->fetch_assoc()) { ?>
                        <tr class="employee" id="employee<?php echo $rows["employee_ID"]; ?>" value="<?php echo $page; ?>">
                            <td class="checkBox"><input type="checkbox" name="<?php echo $rows["employee_ID"]; ?>" onclick="highlightProduct(this)"></td>
                            <?php foreach ($testColumn as $column) { ?>


                                <td>
                                    <?php echo $rows[$column]; ?>
                                </td>
                              

                            <?php } ?> 
                            <td class="actions">
                            <input type="hidden" name="employeeID" id="employeeID" value='<?php echo $rows["employee_ID"]; ?>' />
                                <form method="post" action="read-employee-frontend.php">
                                    <input type="hidden"  name="checkemployeeID" id="checkemployeeID" value='<?php echo $rows["employee_ID"]; ?>'  />
                                    <button type="submit" ><i class="fa-solid fa-eye"></i></button>
                                </form>
                                <form method="post" action="edit-employee-frontend.php">
                                    <input type="hidden" name="checkemployeeID" id="checkemployeeID" value='<?php echo $rows["employee_ID"]; ?>'  />
                                    <button type="submit"><i class="fa-solid fa-pen"></i></button>
                                </form>
                                <i class='fa-solid fa-trash' onclick='displayDeleteQuestion(this)' name='memberID' value='<?php echo $rows["employee_ID"]; ?>'></i>
                            </td>
                        </tr>
                    <?php   }



                    ?>

                </tbody>
            </table>
        </div>
        <div class="pageNumbers-container">
             
            
            <?php
                $sql = "SELECT * FROM employee";
                $result = mysqli_query($conn, $sql);
                $total_employee = mysqli_num_rows($result);

                $total_pages = ceil($total_employee/$num_per_page);
                
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