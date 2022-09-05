<?php

    function OpenConnection()
    {
        $servername = "sql213.epizy.com";
        $username = "epiz_32522623";
        $password = "tgaBdbN4MPFDQu";
        $dbname = "epiz_32522623_gotogromrmDB";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password,$dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo nl2br("Sucess Connection");
        return $conn;
    }

function CloseConnection($conn)
{
    $conn->close();
     echo nl2br("\r\n Sucess Close Connection");
}
?>

