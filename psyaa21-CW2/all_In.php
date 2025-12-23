<html>
    <?php
        $id = $_GET['ID'];
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
        if($movie){$sql="SELECT actID, actName FROM Actor WHERE actID IN (SELECT actID FROM MovieActors WHERE mvID=?)";}
        else{$sql="SELECT mvID, mvTitle FROM Movie WHERE mvID IN (SELECT mvID FROM MovieActors WHERE actID=?)"; }
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute(); 
        $stmt->bind_result($rID,$rName);
        $num_rows = 0;
        
        echo "<ul>";
        while($stmt->fetch()){
            echo "<li style='font-size: 1.5rem;'>";
            echo '<div class="row justify-content-start g-0">
            <div class="col">';
            echo "</h4><a style='font-size: 1.5rem;color:#fff;text-decoration:none;text-transform:capitalize;' href='";
                if($movie){ echo "actorInfo.php?ID=$rID'>".htmlentities($rName);}else {echo "movieInfo.php?ID=$rID'>".htmlentities($rName);}
            echo "</a>";
            echo'</div>';
            echo '<div class="col align-self-center">';
            echo "<button data-bs-toggle='modal' data-bs-target='#removeModal". htmlentities($rID). "' style='background:transparent;border: none !important;font-size: 14;'> <span class='badge rounded-pill bg-danger'>X</span></button>";
            echo '</div>';
            echo "</li>"; 
            echo '
            <div class="modal fade" id="removeModal'. htmlentities($rID).'" tabindex="-1" aria-labelledby="removeModal" aria-hidden="true">
                <div class="modal-dialog" style="color:black;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removeModalLabel">';if($movie){ echo "Remove Actor";}else {echo "Remove Movie";}
            echo '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="';if($movie){ echo "editMovies.php";}else {echo "editActors.php";}
                    echo '" onsubmit="return validate(this)">';
                    if($movie){ echo '<input type="hidden" name="mvID" value='. htmlentities($id).'>
                        <input type="hidden" name="actID" value='. htmlentities($rID).'>';}
                    else {echo '<input type="hidden" name="actID" value='. htmlentities($id).'>
                        <input type="hidden" name="mvID" value='. htmlentities($rID).'>';}
                    echo 
                        '<input type="hidden" name="action" value="remove">
                        <div class="modal-body">';
                        if($movie){ echo 'Are you sure you want to remove <strong style="text-transform:capitalize">"'. htmlentities($rName).'"</strong> from <span style="text-transform:capitalize">'.htmlentities($Title).'</span>?<br>';}
                    else {echo 'Are you sure you want to remove <span style="text-transform:capitalize">'. htmlentities($Name).'</span> from <strong style="text-transform:capitalize">"'.htmlentities($rName).'"</strong>?<br>';}
                            
                    echo '<span style="color:DarkRed">This action cannot be undone.</span>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="close">Close</button>
                            <button type="submit" class="btn btn-success" value="submit">Remove Actor</button>
                        </div> 
                    </form>
                    </div>
                </div>
            </div>
            
            
            ';
            $num_rows += 1;
        }
        $stmt->close();
        echo "</ul>";
        if($num_rows == 0){
            if($movie){ echo "<H5>No listed actors.</H5>";}else {echo "<H5>No listed movies.</H5>";}
        }
    ?>
</html>