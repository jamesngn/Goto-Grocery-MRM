<?php 
    function addEmployee($c_fname,$c_lname,$c_email,$c_password)
    {
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        include '../includes/dbAuthentication.inc';
        // put all the stuff to be done following form submission in here
       if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $conn = OpenConnection();
            
            // the cleaned – "safe" – inputs ready to be added to the database
            $c_fname = mysqli_real_escape_string($conn, cleanInput($_POST["fname"]));
            $c_lname = mysqli_real_escape_string($conn, cleanInput($_POST["lname"]));
            $c_email = mysqli_real_escape_string($conn, cleanInput($_POST["email"]));
            $c_password = mysqli_real_escape_string($conn, cleanInput($_POST["password"]));

            // add to the database

            $sql = "INSERT INTO employee (fname, lname, email, password)
            VALUES ('$c_fname','$c_lname','$c_email','$c_password')";  
            


              
        }
      }
    function errorMessage($message)
    {
        echo $message;
    }
?>
