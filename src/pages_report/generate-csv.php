<?php 
ob_start();
// Database Connection
 include '../includes/dbAuthentication.inc';
ob_end_clean();
 $conn = OpenConnection();
 $table = $_POST['Table'];
 //Zipping
 $zipname = 'csv.zip';
 $zip = new ZipArchive;
 $zip->open($zipname, ZipArchive::CREATE);

 for ($i = 0; $i < count($table); $i++) {

    // create a temporary file
    $fd = fopen('php://temp/maxmemory:1048576', 'w');
    if (false === $fd) {
        die('Failed to create temporary file');
    }
    
    // Table Column
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE  TABLE_SCHEMA='epiz_32522623_gotogromrmDB' and TABLE_NAME='".$table[$i]."'";
    $column_name = mysqli_query($conn,$sql) or die("Selection Error " . mysqli_error($conn));
    $column_table = array();


    // get data from table
    $sql = "SELECT * FROM ".$table[$i];
    $result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));

    // write the data to csv
    if (mysqli_num_rows($column_name) > 0)
    {
        while($column_row = mysqli_fetch_array($column_name))
        {
            array_push($column_table, $column_row[0]);
            
        }
        fputcsv($fd, $column_table);
    }
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fd, $row);
        }
    }

    // return to the start of the stream
    rewind($fd);
     
    // add the in-memory file to the archive, giving a name
    $zip->addFromString('file-'.$table[$i].'.csv', stream_get_contents($fd) );
    //close the file
    fclose($fd);
}
CloseConnection($conn);
// close the archive
$zip->close();


header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
// remove the zip archive
unlink($zipname);
//<!--Author:THANH NGUYEN DATE:06/09/2022-->
?>
