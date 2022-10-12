<?php
function readEmployee($employeID)
{
    if ($employeID) {
        require '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "SELECT * FROM employee WHERE employee_ID = '$employeID'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {

                $employee = mysqli_fetch_assoc($result);
                return $employee;
            }
        } else {
            echo nl2br("\r\n SQL error: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
}
function hasEmployee($employeeID)
{
    if (is_null($employeeID)) {
        return false;
    } else {
        return true;
    }
}

function getAllEmployeeColumn()
{
    ob_start();
    require_once '../includes/dbAuthentication.inc';
    ob_end_clean();
    $conn = OpenConnection();
    // Table Column
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE  TABLE_SCHEMA='epiz_32522623_gotogromrmDB' and TABLE_NAME='employee'";
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

function getAllEmployeeRow()
{
    ob_start();
    require_once '../includes/dbAuthentication.inc';
    ob_end_clean();
    $conn = OpenConnection();

    // get data from table
    $sql = "SELECT * FROM employee";
    $result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));

    return $result;
}
?>

<?php

?>
