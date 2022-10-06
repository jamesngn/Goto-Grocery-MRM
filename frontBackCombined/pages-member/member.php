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
                <?php $testRow = getAllMemberRow(); ?>
                <tbody>

                    <?php
                    while ($rows = $testRow->fetch_assoc()) { ?>
                        <tr id="member<?php echo $rows["customer_id"]; ?>" value="<?php echo $page; ?>">
                            <td class="checkBox"><input type="checkbox" name="<?php echo $rows["customer_id"]; ?>" onclick="highlightProduct(this)"></td>
                            <?php foreach ($testColumn as $column) { ?>


                                <td>
                                    <?php echo $rows[$column]; ?>
                                </td>

                            <?php } ?>
                            <td class="actions">
                                <form method="post" action="read-member-frontend.php">
                                    <input type="hidden" name="existmemberID" id="existmemberID" value='<?php echo $rows["customer_id"]; ?>' />
                                    <button type="submit"><i class="fa-solid fa-eye"></i></button>
                                </form>
                                <form method="post" action="edit-member-frontend.php">
                                    <input type="hidden" name="existmemberID" id="existmemberID" value=' <?php echo $rows["customer_id"]; ?>' />
                                    <button type="submit"><i class="fa-solid fa-pen"></i></button>
                                </form>
                                <i class='fa-solid fa-trash' onclick='displayDeleteQuestion(this)' name='memberID' value='<?php echo $rows["customer_id"]; ?>'></i>
                            </td>
                        </tr>
                    <?php }

                    require_once 'php-function/dbAuthentication.php';
                    $conn = OpenConnection();
                    CloseConnection($conn);
                    ?>

                </tbody>
            </table>
        </div>

    </section>
    <script src="../js/member.js"></script>
    <script src="../js/sidebar.js"></script>
</body>

</html>