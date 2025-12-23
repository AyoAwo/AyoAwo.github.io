<?php 
        $actorsearch = $_GET['Search'];
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyaa21_COMP1004';
        $db_user = 'psyaa21_COMP1004';
        $db_pass = 'Winter1004'; 
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
        if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        $sql="SELECT actID,actName FROM Actor";
        if (!(empty($actorsearch))){
            $sql .= " WHERE actName LIKE ?";
        }
        $stmt = $conn->prepare($sql);
        if (!(empty($actorsearch))){
            $querySearch = "%".$actorsearch."%";
            $stmt->bind_param("s",$querySearch);;
        }
        $stmt->execute(); 
        $stmt->bind_result($ID, $Name);
        $num_rows = 0;
        ?>

<html>
    <head> 
        <TITLE>AMdb | <?php echo 'Search Results Related to "'.htmlentities($actorsearch).'"' ?></TITLE>
    </head> 
    <body> 
        <div id="menuDropdown" class="sidebar">
            <a href="home.html"><img src="assets/house.png" style="width:40px;height:40px;"></a>
            <a href="actors.html">Actors</a>
            <a href="movies.html">Movies</a>
        </div>
        <div id="main">  
        <?php 
        if((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){
            $num_rows = 0; 
        }
        elseif(!(isset($_GET['Search']))){
            echo '<script>alert("Error. No Search value found")</script>';
            echo '<script>history.back()</script>';
        }
        elseif (!(empty($actorsearch))){
            include("searchHeader.php");
        }
        elseif((similar_text($_SERVER['REQUEST_URI'],'search_actors.php'))==17){
            echo '<script>alert("Search is empty. Please enter something to search.")</script>';
            echo '<script>history.back()</script>';
        }        
        ?>
        <div class="container">
              <div class="row justify-content-center">
                <div class="col-auto">
                    <table class="table table-dark table-striped table-hover text-center" style='width:300px'>
                        <thead>
                            <tr> 
                                <th style="width:300px">Name</th> 
                            </tr> 
                        </thead>
                        <tbody class="table-group-divider">
                            <?php 
                            while($stmt->fetch()){ 
                                echo "<tr>";
                                echo "<td style='width:300px'>";
                                    echo "<a  style='color:#fff;text-decoration:none;text-transform:capitalize;' href='actorInfo.php?ID=$ID'>". htmlentities($Name) ."</td>";
                                echo "</tr>"; 
                                $num_rows += 1;
                            }
                            $stmt->close();
                            if($num_rows == 0){
                                echo "<tr>";
                                echo "<td colspan='4'>";
                                echo '<H3> Sorry, no results matching "'.htmlentities($actorsearch).'"</H3>';  
                                echo "</td></tr>";
                            }
                            elseif($num_rows == 1){
                                if ((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))!=18){
                                    header('Location: actorInfo.php?ID='.htmlentities($ID));
                                }
                                else{
                                    $soloActorResult=$ID;
                                }
                            }
                            ?> 
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
        
        </div>
    </body> 

</html> 