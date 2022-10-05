 <?php
    function editMember($c_fname,$c_lname,$c_email,$c_memberID)
    {
        function cleanInput($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        require 'dbAuthentication.php';
        // put all the stuff to be done following form submission in here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // the cleaned – "safe" – inputs ready to be added to the database
            $c_fname = mysqli_real_escape_string($conn, cleanInput( $c_fname));
            $c_lname = mysqli_real_escape_string($conn, cleanInput( $c_lname));
            $c_email = mysqli_real_escape_string($conn, cleanInput($c_email));

            // add to the database

            $sql =
                "UPDATE member 
            SET customer_firstname =?, 
            customer_lastname = ?, 
            customer_email = ? 
            WHERE customer_id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $c_fname, $c_lname, $c_email, $c_memberID);


            if ($stmt->execute()) {
                echo nl2br("\r\n Edited customer $c_fname $c_lname to the database.");
            } else {
                echo nl2br("\r\n SQL error: " . mysqli_error($conn));
            }
            $stmt->close();
           
            return true;
        }
    }
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


    ?>

