<html> 
    <?php
        header('Location: actors.html');
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyaa21_COMP1004';
        $db_user = 'psyaa21_COMP1004';
        $db_pass = 'Winter1004';
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
        if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        if(empty($firstname) || empty($lastname)){
            echo "<script>alert('error')</script>";
            return false;
        }
        else{
            $input = $firstname." ".$lastname;
            echo "<script>alert('$input')</script>";
            
        }
        $sql="INSERT INTO Actor(actName) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$input);
        if(!($stmt)){
            echo "<script>alert('Error - Actor already in database')</script>";
        }
        else{
            $stmt->execute();
            echo "<script>form.reset();</script>";
        }
        
?>
</html>