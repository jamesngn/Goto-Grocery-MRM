<?php
 
    // Database Connection
    include '../includes/dbAuthentication.inc';
    $conn = OpenConnection();



    // Table Column
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE  TABLE_SCHEMA='epiz_32522623_gotogromrmDB' and TABLE_NAME='member'";
    $column_name = mysqli_query($conn,$sql) or die("Selection Error " . mysqli_error($conn));
    $header = array();


    // get users list
    $sql = "SELECT * FROM member";
    $result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));
 
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=users-sample.csv');
    $fOutput = fopen('php://output', 'w');
    if (mysqli_num_rows($column_name) > 0)
    {
        while($column_row = mysqli_fetch_array($column_name))
        {
            array_push($header, $column_row);
            fputcsv($fOutput, $header);
        }
        
    }
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fOutput, $row);
        }
    }
    fclose($fOutput);
    CloseConnection($conn);
?>
