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
        $testColumn = getAllMemberColumn();
        ?>
        <div class="table-responsive">
            <table class="table table-bordered",border="1px", cellpadding="4" cellspacing="50">
                <thead>
                    <tr>
                        <?php
                        for ($i = 0; $i <= sizeof($testColumn) - 1; $i++) {
                            echo "<th>$testColumn[$i]</th>";
                        }
                        echo "<th>Operation</th>";
                        ?>
                </thead>
                <?php
                $testRow = getAllMemberRow();
                ?>
                <tbody>
  
                        <?php
                        while ($rows=$testRow->fetch_assoc()){

                            echo "<tr>";
                              foreach ($testColumn as $column) 
                              {
                             
                                 echo "<td>$rows[$column]</td>";
                                 
                              }
                              echo '<td><form method="post" action="">
                                 <fieldset>
                                     <p>  
                                         <input type="hidden" name="customer_id" id="customer_id" '; 
                                         echo 'value="'.$rows["customer_id"];
                                         echo '"/>
                                     </p>
                                     <p>
                                     <input type="submit" value="Submit">
                                     </p>
                                 </fieldset>
                             </form></td> ';
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