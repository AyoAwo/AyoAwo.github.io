<?php 
        $ID = $_GET['ID'];
        $movie=0;
        if ((similar_text($_SERVER['REQUEST_URI'],'movieInfo.php'))==13){
            $movie=1;
        }
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyaa21_COMP1004';
        $db_user = 'psyaa21_COMP1004';
        $db_pass = 'Winter1004'; 
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
        if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        if ($movie){
            $sql=" SELECT actID, actName FROM Actor WHERE actID NOT IN (SELECT actID FROM MovieActors WHERE mvID=?);";
        }
        else{
            $sql=" SELECT mvID, mvTitle FROM Movie WHERE mvID NOT IN (SELECT mvID FROM MovieActors WHERE actID=?);";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$ID);
        $stmt->execute();
        $stmt->bind_result($rID, $rName);
        $num_rows = 0; 
        echo '<select class="form-select" aria-label="Select';
        if($movie){echo ' Movie" name="mvID" id="Select Movie"> ';}else{echo ' Actor" name="actID" id="Select Actor">';} 
        echo '<option selected value="">Select';
        if($movie){echo ' Actor';}else{echo ' Movie';}
        echo '</option>';
                while($stmt->fetch()){ 
                    echo '<option value="'.htmlentities($rID).'" style="text-transform:capitalize">';
                    echo htmlentities($rName);
                    echo "</options>";
                    $num_rows += 1;
                }
                if($num_rows == 0){
                    echo '<option value=""> Error- No ';
                    if($movie){echo 'actors';}else{echo 'movies';}
                    echo ' available</options>';
                }
        $stmt->close();
            ?>
        </select>