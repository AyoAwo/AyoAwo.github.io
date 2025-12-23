<?php 
        $id = $_GET['ID'];
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyaa21_COMP1004';
        $db_user = 'psyaa21_COMP1004';
        $db_pass = 'Winter1004'; 
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
        if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        $sql="SELECT actName FROM Actor WHERE actID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute(); 
        $stmt->bind_result($Name);
        $stmt->fetch();
        $stmt->close();
        ?>

<html>
    <head>
        <TITLE>AMdb | <?php echo htmlentities($Name) ?></TITLE>
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
        
        ?>
        <br><br>
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col">
                    <?php
                        echo '<img src="';
                        $filename = "assets/headshots/actor".$id.".png";
                        if(file_exists($filename) ){
                                    echo htmlentities($filename).'"';
                        }
                        else{
                            echo 'assets/headshots/headshot.png"';
                        }
                        echo '>';?>
                    </div>
                
        <?php 
                    echo '<div class="col"><br><H1 style="text-transform:capitalize">'. htmlentities($Name).'</H1>';
                        echo '<br><br><br>';
                        echo '
                        <div class="btn-group" role="group" aria-label="Edit Actor Buttons">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal">
                                Edit Actor &#128394
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMovieModal">
                                Add Movie &#127916
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                Delete Actor &#128465
                            </button>
                            
                        </div>
                        ';
                    echo '</div>';
                    echo '<div class="col"><br>';
                    echo '<p><H3>Featured in:</H3></p>';
                        echo '<div id="featuresList">';
                            include("all_In.php");
                        echo '</div>';
                    echo '</div>';
             
        ?>
                </div> 
            </div>

            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
                <div class="modal-dialog" style="color:black;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Actor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="editActors.php" enctype="multipart/form-data" onsubmit="return validate(this)" >
                        <input type="hidden" name="actID" value='<?php echo htmlentities($id)?>'> 
                        <input type="hidden" name="action" value='update'>
                        <div class="modal-body">
                            Please update the actor's name.
                            <br>
                            <?php
                                $nameSplit = explode(" ",$Name." ");
                                $firstname=$nameSplit[0];
                                $lastname=$nameSplit[1];
                            ?>
                            <div class="input-group mb-3">
                                <input type="name" class="form-control" name="firstname" id="First Name" aria-describedby="FirstNameInput" placeholder="First Name"value="<?php echo htmlentities($firstname)?>">
                            </div>
                           <div class="input-group mb-3">
                                <input type="name" class="form-control" name="lastname" id="Last Name" aria-describedby="LastNameInput" placeholder="Last Name" value="<?php echo htmlentities($lastname)?>">
                            </div>
                            <label for="headshotImage" class="form-label">Upload Actor's Image <small>(.PNG files only)</small></label>
                            <div class="input-group mb-3">
                                <input type="file" accept="image/png" class="form-control" id="uploadImage" name="headshot">
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
                    <form method="POST" action="editActors.php" onsubmit="return validate(this)">
                        <input type="hidden" name="actID" value='<?php echo htmlentities($id)?>'>
                        <input type="hidden" name="action" value='delete'>
                        <div class="modal-body">
                            Are you sure you want to delete <strong style='text-transform:capitalize'><?php echo htmlentities($Name)?></strong> from the database? <br>
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
            
            <div class="modal fade" id="addMovieModal" tabindex="-1" aria-labelledby="addMovieModal" aria-hidden="true">
                <div class="modal-dialog" style="color:black;">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMovieModalLabel">Add Movie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="editActors.php" onsubmit="return validate(this)">
                        <input type="hidden" name="actID" value='<?php echo htmlentities($id)?>'>
                        <input type="hidden" name="action" value='add'>
                        <div class="modal-body">
                        
                            Select which movie the actor featured in.
                            <?php include("allNotIn.php") ?>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="close">Close</button>
                            <button type="submit" class="btn btn-success" value="submit">Add Movie</button>
                        </div> 
                    </form>
                    </div>
                </div>
            </div>

        </div>
    </body> 

</html> 