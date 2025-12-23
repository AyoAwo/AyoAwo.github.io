<html> 
    <?php
        $action = trim($_POST['action']);
        $mvID = $_POST['mvID'];
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyaa21_COMP1004';
        $db_user = 'psyaa21_COMP1004';
        $db_pass = 'Winter1004';
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
        if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        if(empty($action)){
            die("Action not received\n</body>\n</html>");
        }
        elseif($action == 'add'){
            header('Location: movieInfo.php?ID='.$mvID);
            $actID = $_POST['actID'];
            $sql="INSERT INTO MovieActors(actID,mvID) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii",$actID,$mvID);
        }
        elseif($action == 'delete'){
            header('Location: movies.html');
            $sql="DELETE FROM Movie WHERE mvID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i",$mvID);
        }
        elseif($action == 'remove'){
            header('Location: movieInfo.php?ID='.$mvID);
            $actID = $_POST['actID'];
            $sql="DELETE FROM MovieActors WHERE actID=? AND mvID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iy",$actID,$mvID);
        }
        elseif($action == 'update'){
            header('Location: movieInfo.php?ID='.$mvID);
            $Title = trim($_POST['title']);
            $Genre = trim($_POST['genre']);
            $Price = $_POST['price'];
            $Year = $_POST['year'];
            if(empty($Title) || empty($Genre) ||empty($Price) || empty($Year)){
                echo "<script>alert('error')</script>";
                return false;
            }
            $sql="UPDATE Movie SET mvTitle=?, mvGenre=?,mvPrice=?,mvYear=? WHERE mvID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdii",$Title,$Genre,$Price,$Year,$mvID);
            if (($_FILES['poster']['name']!="")){
                // Where the file is going to be stored
                    $target_dir = "assets/posters/";
                    $file = $_FILES['poster']['name'];
                    $path = pathinfo($file);
                    $filename = 'movie'.$mvID;
                    $temp_name = $_FILES['poster']['tmp_name'];
                    $path_filename_ext = $target_dir.$filename.".png";
                 
                move_uploaded_file($temp_name,$path_filename_ext);
            }
        }
        
        if(!($stmt)){
            echo "<script>alert('error')</script>";
        }
        else{
            $stmt->execute();
            echo "<script>form.reset();</script>";
        }
        $stmt->close();    
?>
</html>