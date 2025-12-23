 <?php 
        $id = $_GET['ID'];
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyaa21_COMP1004';
        $db_user = 'psyaa21_COMP1004';
        $db_pass = 'Winter1004'; 
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
        if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        $sql="SELECT mvTitle,mvPrice,mvYear,mvGenre FROM Movie WHERE mvID =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute(); 
        $stmt->bind_result($Title, $Price, $Year, $Genre );
        $stmt->fetch();
        $stmt->close();
       ?>
<html>
    <head>
        <TITLE>AMdb | <?php echo htmlentities($Title) ?></TITLE>
        <link rel="icon" type="image/png" href="assets/AMDb-logo.png"/>
    </head> 
    <body> 
       
       <div id="menuDropdown" class="sidebar">
            <a href="home.html"><img src="assets/house.png" style="width:40px;height:40px;"></a>
            <a href="actors.html">Actors</a>
            <a href="movies.html">Movies</a>
        </div>  
        <div id="main">
       <?php
        include("searchHeader.php");
                echo "<br><br>";
                echo '<div class="container">
                        <div class="row justify-content-end">';
                    echo '<div class="col"><H1 style="text-transform:capitalize">'. htmlentities($Title).'</H1>';
                        echo '<div class="row">';
                            echo '<div class="col-6">';
                                echo '<p><H3>Release Year: '.htmlentities($Year).'</H3></p>';
                                echo '<p><H3 style="text-transform:capitalize">Genre: '.htmlentities($Genre).'</H3></p>';             
                                echo '<p><H3>Ticket Price: £'. htmlentities($Price);
                                if((floor($Price) == $Price)){
                                    echo ".00";
                                }
                                elseif(floor($Price * 10) == ($Price * 10)){
                                    echo "0";
                                }
                                echo '</H3></p>';
                                echo '<br><br><br>';
                                echo '
                                    <div class="btn-group" role="group" aria-label="Edit Actor Buttons">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateMovieModal">
                                            Edit Movie &#128394
                                        </button>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addActorModal">
                                            Add Actor &#127917
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            Delete Movie &#128465
                                        </button>
                                        
                                    </div>
                                    ';
                            echo '</div>';
                            echo '<div class="col-6">';
                                echo '<p><H3>Featuring:</H3></p>';
                                echo '<div id="featuresList">';
                                    include("all_In.php");
                                echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
        ?>
                <div class="col-3">
                <?php
                echo '<img src="';
                $filename = "assets/posters/movie".$id.".png";
                if(file_exists($filename) ){
                            echo htmlentities($filename).'"';
                 }
                else{
                    echo 'assets/posters/poster.png"';
                }
                echo '>';?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateMovieModal" tabindex="-1" aria-labelledby="updateMovieModal" aria-hidden="true">
                <div class="modal-dialog" style="color:black;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateMovieModalLabel">Update Movie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="editMovies.php" enctype="multipart/form-data" onsubmit="return validate(this)">
                        <input type="hidden" name="mvID" value='<?php echo htmlentities($id)?>'> 
                        <input type="hidden" name="action" value='update'>
                        <div class="modal-body">
                            Please update the movie's info.
                            <br>
                            <?php include("movieForm.php"); ?>
                            <script>
                                fillField('Title','<?php echo htmlentities($Title)?>');
                                fillField('Genre','<?php echo htmlentities($Genre)?>');
                                fillField('Price','<?php echo htmlentities($Price)?>');
                                fillField('Year','<?php echo htmlentities($Year)?>');
                            </script>
                            <label for="posterImage" class="form-label">Upload Movie Poster <small>(.PNG files only)</small></label>
                            <div class="input-group mb-3">
                                <input type="file" accept="image/png" class="form-control" id="uploadImage" name="poster">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="close">Close</button>
                            <form>
                            <button type="submit" class="btn btn-warning" value="submit">Update</button>
                            
                        </div>
                    </form>
                    </div>
                </div>
            </div>     

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                <div class="modal-dialog" style="color:black;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="editMovies.php" onsubmit="return validate(this)">
                        <input type="hidden" name="mvID" value='<?php echo htmlentities($id)?>'>> 
                        <input type="hidden" name="action" value='delete'>
                        <div class="modal-body">
                            Are you sure you want to delete <strong style='text-transform:capitalize'>"<?php echo htmlentities($Title)?>"</strong> from the database? <br>
                            <span style="color:DarkRed">This action cannot be undone.</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="close">Close</button>
                            <form>
                            <button type="submit" class="btn btn-danger" value="submit">Delete</button>
                            
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="addActorModal" tabindex="-1" aria-labelledby="addActorModal" aria-hidden="true">
                <div class="modal-dialog" style="color:black;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addActorModalLabel">Add Actor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="editMovies.php" onsubmit="return validate(this)">
                        <input type="hidden" name="mvID" value='<?php echo htmlentities($id)?>'>
                        <input type="hidden" name="action" value='add'>
                        <div class="modal-body">
                        
                            Select which actor features in this movie.
                            <?php include("allNotIn.php") ?>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="close">Close</button>
                            <button type="submit" class="btn btn-success" value="submit">Add Actor</button>
                        </div> 
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </body> 

</html> 