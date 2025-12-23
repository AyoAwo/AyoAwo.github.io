<html>
    <head>
        <?php include("imports.php");?>
    </head>
    <body>
        <?php
        
        $id = $_GET['ID'];
        ?>       
            <div class="banner">
                <div class="menu-container" onclick="menuToggle(this)"> 
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div> 
                </div>
                <H1>
                <?php
                    if(!(empty($id))){
                        echo '<a href="home.html"><img src="assets/AMDb-logo.png" style="width:150px;height:150px;"></a>';
                        echo '</H1></div><br>';
                        echo '<button onclick="';
                        if((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){
                            echo "window.location='home.html'"; 
                        }
                        elseif ((similar_text($_SERVER['REQUEST_URI'],'movies'))>1){
                            echo "window.location='movies.html'";
                        }
                        else{
                            echo "window.location='actors.html'";
                        }
                        echo '" type="button" class="btn btn-outline-primary active" style="margin: 0 1.5%;">
                            <img src="assets/back.png" style="width:40px;height:40px;"> Back to ';
                        if((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){
                            echo "Home";
                        }
                        elseif ((similar_text($_SERVER['REQUEST_URI'],'movies'))>1){
                            echo 'Movies';
                        }
                        else{
                            echo 'Actors';
                        }
                        echo'</button>';
                        return;
                    }
                    else{
                        $titlesearch = $_GET['Search'];
                        $Genre = $_GET['Genre'];
                        if(!(empty($titlesearch))){
                            echo 'Search Results Related to "'.htmlentities($titlesearch).'"';
                        }
                        elseif(!(empty($Genre))){
                            echo htmlentities($Genre)." Movies";
                        }
                    }
                ?>
                </H1>
                
            </div>
            <br>
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-10">
                    <form action=<?php if((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){echo 'searchDatabase.php';}
                                        elseif ((similar_text($_SERVER['REQUEST_URI'],'movies'))>1){ echo "search_movies.php";}
                                        else{echo "search_actors.php";}
                    ?> onSubmit="return validate(this)">
                    
                        <div class="input-group mb-3" name=
                                <?php if((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){echo 'mainSearch';}
                                        elseif ((similar_text($_SERVER['REQUEST_URI'],'movies'))>1){ echo 'movie';}
                                        else{echo 'actor';}?>>
                            <button onclick="<?php if((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){ echo "window.location='home.html'";}
                                                    elseif ((similar_text($_SERVER['REQUEST_URI'],'movies'))>1){ echo "window.location='movies.html'";}
                                                    else{echo "window.location='actors.html'";}?>" type="button" class="btn btn-outline-primary active" value="Back">
                                <img src="assets/back.png" style="width:40px;height:40px;"> Back to  <?php if((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){ echo "Home";}
                                                                                                                                elseif ((similar_text($_SERVER['REQUEST_URI'],'movies'))>1){ echo 'Movies';}
                                                                                                                                else{echo 'Actors';}?>
                            </button>
                            <input type="text" class="form-control" name="Search" placeholder= "Search All <?php if((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){echo '';}
                                                                                                                    elseif ((similar_text($_SERVER['REQUEST_URI'],'movies'))>1){ echo 'Movies...';}
                                                                                                                    else{echo 'Actors...';}
                            ?>"></input>
                            <button class="btn btn-success" type="submit" id=
                            <?php if((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){echo 'Database-Search';}
                                    elseif ((similar_text($_SERVER['REQUEST_URI'],'movies'))>1){ echo 'Movie-Search';}
                                    else{echo 'Actor-Search';}
                            ?> value="Submit">Search</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            
        <br>
    </body>
</html>