<?php

    function OpenConnection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "epiz_32522623_gotogromrmDB";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password,$dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function CloseConnection($conn)
    {
        $conn->close();
    }
?>

