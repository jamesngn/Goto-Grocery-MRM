<?php
function readMember($memberID)
{
    if ($memberID) {
        require 'dbAuthentication.php';
        $conn = OpenConnection();

        $sql = "SELECT * FROM member WHERE customer_id = '$memberID'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {

                $member = mysqli_fetch_assoc($result);
                return $member;
            }
        } else {
            echo nl2br("\r\n SQL error: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
}
function hasMember($memberExist)
{
    if (is_null($memberExist)) {
        return false;
    } else {
        return true;
    }
}

function getAllMemberColumn()
{
    ob_start();
    require_once 'dbAuthentication.php';
    ob_end_clean();
    $conn = OpenConnection();
    // Table Column
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE  TABLE_SCHEMA='epiz_32522623_gotogromrmDB' and TABLE_NAME='member'";
    $column_name = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));
    $column_table = array();

    // write the data to csv
    if (mysqli_num_rows($column_name) > 0) {
        while ($column_row = mysqli_fetch_array($column_name)) {
            array_push($column_table, $column_row[0]);
        }
        return $column_table;
    }

    CloseConnection($conn);
}

function getAllMemberRow()
{
    ob_start();
    require_once 'dbAuthentication.php';
    ob_end_clean();
    $conn = OpenConnection();

    // get data from table
    $sql = "SELECT * FROM member";
    $result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));

    return $result;
}
?>

<?php
/*
    echo nl2br("\r\n" . $_SESSION["memberID"]);
    $c_memberID = $_SESSION["memberID"];
    require 'dbAuthentication.php';
    $conn = OpenConnection();
    $sql = "SELECT * FROM member WHERE customer_id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $c_memberID);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo nl2br("\r\n Customer_id: " . $row["customer_id"]);
                echo nl2br("\r\n First Name: " . $row["customer_firstname"]);
                echo nl2br("\r\n Last Name " . $row["customer_lastname"]);
                echo nl2br("\r\n Email:" . $row["customer_email"]);
                echo nl2br("\r\n Password:" . $row["CREATED_AT"]);
            }
            if (!session_destroy()) {
                echo "session not destroyed";
            } else {
                echo "session destroyed";
            }
        } else {

            echo nl2br("\r\n Error:DB is incorrect.");
        }
    } else {
        echo nl2br("\r\n SQL error: " . mysqli_error($conn));
    }
    $stmt->close();
    CloseConnection($conn);
    */
//<!--Author:THANH NGUYEN DATE:05/09/2022-->
?>
