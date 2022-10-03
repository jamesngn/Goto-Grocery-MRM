<?php
include '../includes/header.inc';
include 'php-function/read-member.php'
?>

<body>
    <?php include '../includes/sidebar.inc'; ?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">Display MEMEBER</span>
        </div>


        <?php
        $testData = getAllMemberColumn();
        ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <?php
                        for ($i = 0; $i <= sizeof($testData) - 1; $i++) {
                            echo "<th>$testData[$i]</th>";
                        }

                        ?>
                </thead>
                <?php
                $testRow = getAllMemberRow();
                ?>
                <tbody>
  
                        <?php
                        while ($rows=$testRow->fetch_assoc()){

                            echo "<tr>";
                              foreach ($testData as $column) 
                              {
                             
                                 echo "<td>$rows[$column]</td>";
                               
                              }
                              echo "</tr>";
                            }
                            require_once 'php-function/dbAuthentication.php';
                            $conn = OpenConnection();
                            CloseConnection($conn);      
                        ?>
                
                </tbody>
            </table>
        </div>

    </section>

    <script src="../js/sidebar.js"></script>
</body>

</html>