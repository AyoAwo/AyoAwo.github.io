<html> 
    <?php
        header('Location: movies.html');
        $Title = trim($_POST['title']);
        $Genre = trim($_POST['genre']);
        $Price = $_POST['price'];
        $Year = $_POST['year'];
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyaa21_COMP1004';
        $db_user = 'psyaa21_COMP1004';
        $db_pass = 'Winter1004';
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
        if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        if(empty($Title) || empty($Genre) ||empty($Price) || empty($Year)){
            echo "<script>alert('error')</script>";
            return false;
        }
        $sql="INSERT INTO Movie(mvTitle,mvGenre,mvPrice,mvYear) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi",$Title,$Genre,$Price,$Year);
        if(!($stmt)){
            echo "<script>alert('Error - Movie already in database')</script>";
        }
        else{
            $stmt->execute();
            echo "<script>form.reset();</script>";
        }
        $stmt->close();
?>
</html>