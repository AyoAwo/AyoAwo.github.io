<?php 
        $titlesearch = $_GET['Search'];
        $genresearch = $_GET['Genre'];
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyaa21_COMP1004';
        $db_user = 'psyaa21_COMP1004';
        $db_pass = 'Winter1004'; 
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
        if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        $sql="SELECT mvID,mvTitle,mvPrice,mvYear,mvGenre FROM Movie";
        if (!(empty($titlesearch))){
            $sql .= " WHERE mvTitle LIKE ?";
        }
        if(!(empty($genresearch))){
            $sql .= " WHERE mvGenre LIKE ?";
        }
        $stmt = $conn->prepare($sql);
        if (!(empty($titlesearch))){
            $querySearch = "%".$titlesearch."%";
            $stmt->bind_param("s",$querySearch);
        }
        if(!(empty($genresearch))){
            $genreQuery = "%".$genresearch."%";
            $stmt->bind_param("s",$genreQuery);
        }
        $stmt->execute();
        $stmt->bind_result($ID, $Title, $Price, $Year, $Genre );
        $num_rows = 0; 
        ?>

<html>
    <head> 
        <?php if(!(empty($titlesearch))){
            echo '<TITLE>AMdb | Search Results Related to "'.htmlentities($titlesearch).'"</TITLE>';
            }
            elseif(!(empty($genresearch))){
                echo '<TITLE>AMdb | '.htmlentities($genresearch).' Movies</TITLE>';
            }
        ?>
        
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
        elseif(!(isset($_GET['Search'])) && !(isset($_GET['Genre']))){
            echo '<script>alert("Error. No Search value found")</script>';
            echo '<script>history.back()</script>';
        }
        elseif (!(empty($titlesearch)) || !(empty($genresearch))){
            include("searchHeader.php");
            
        }
        elseif((similar_text($_SERVER['REQUEST_URI'],'search_movies.php'))==17){
            echo '<script>alert("Search is empty. Please enter something to search.")</script>';
            echo '<script>history.back()</script>';
        }     
        
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <table class="table table-dark table-striped table-hover text-center ">
                        <thead>
                            <tr> 
                                <th>Title</th> 
                                <th>Price</th> 
                                <th>Year</th> 
                                <th>Genre</th>
                            </tr> 
                        </thead>
                        <tbody class="table-group-divider">
                            <?php 
                            while($stmt->fetch()){ 
                                echo "<tr>";
                                echo "<td>";
                                    echo "<a  style='color:#fff;text-decoration:none;text-transform:capitalize' href='movieInfo.php?ID=$ID'>". htmlentities($Title) ."</td>";
                                echo "<td> £". htmlentities($Price);
                                if((floor($Price) == $Price)){
                                    echo ".00";
                                }
                                elseif(floor($Price * 10) == ($Price * 10)){
                                    echo "0";
                                }
                                echo "</td>"; 
                                echo "<td>". htmlentities($Year) ."</td>";
                                echo "<td style='text-transform:capitalize' >".htmlentities($Genre) ."</td>"; 
                                echo "</tr>"; 
                                $num_rows += 1;
                            }
                            $stmt->close();
                            if($num_rows == 0){
                                echo "<tr>";
                                echo "<td colspan='4'>";
                                echo '<H3> Sorry, no results matching "'.htmlentities($titlesearch).'"</H3>';  
                                echo "</td></tr>";
                            }
                            elseif($num_rows == 1 && !(isset($_GET['Genre']))){
                                if ((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))!=18){
                                    header('Location: movieInfo.php?ID='.htmlentities($ID));
                                }
                                else{
                                    $soloMovieResult=$ID;
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