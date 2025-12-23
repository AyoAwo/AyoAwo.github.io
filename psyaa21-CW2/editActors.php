<html> 
    <?php
        $action = trim($_POST['action']);
        $actID = $_POST['actID'];
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
            header('Location: actorInfo.php?ID='.$actID);
            $mvID = $_POST['mvID'];
            $sql="INSERT INTO MovieActors(actID,mvID) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii",$actID, $mvID);
        }
        elseif($action == 'delete'){
            header('Location: actors.html');
            $sql="DELETE FROM Actor WHERE actID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i",$actID);
        }
        elseif($action == 'remove'){
            header('Location: actorInfo.php?ID='.$actID);
            $mvID = $_POST['mvID'];
            $sql="DELETE FROM MovieActors WHERE actID=? AND mvID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii",$actID,$mvID);
        }
        elseif($action == 'update'){
            header('Location: actorInfo.php?ID='.$actID);
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            if(empty($firstname) || empty($lastname)){
                echo "<script>alert('error')</script>";
                return false;
            }
            else{
                $input = $firstname." ".$lastname;                
            }
            $sql="UPDATE Actor SET actName=? WHERE actID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si",$input,$actID);
            if (($_FILES['headshot']['name']!="")){
                // Where the file is going to be stored
                    $target_dir = "assets/headshots/";
                    $file = $_FILES['headshot']['name'];
                    $path = pathinfo($file);
                    $filename = 'actor'.$actID;
                    $temp_name = $_FILES['headshot']['tmp_name'];
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