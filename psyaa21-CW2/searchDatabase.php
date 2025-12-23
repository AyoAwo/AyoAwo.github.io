<?php
        ob_start();
        $action = $_GET['type'];
        $search = $_GET['Search'];
        $total = 0;
        if($action=="actors"){
            header('Location: search_actors.php?Search='.$search);
        }
        elseif($action=="movies"){
            header('Location: search_movies.php?Search='.$search);
        }
        else{
            $db_host = 'mysql.cs.nott.ac.uk';
            $db_name = 'psyaa21_COMP1004';
            $db_user = 'psyaa21_COMP1004';
            $db_pass = 'Winter1004';
            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
            if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        }

        
?>
<html>
    <head> 
        <TITLE>AMdb | <?php echo 'Search Results Related to "'.htmlentities($search).'"' ?></TITLE>
    </head> 
    <body> 
        <div id="menuDropdown" class="sidebar">
            <a href="home.html"><img src="assets/house.png" style="width:40px;height:40px;"></a>
            <a href="actors.html">Actors</a>
            <a href="movies.html">Movies</a>
        </div>
        <div id="main">  
            <?php 
            if (!(empty($search))){
                include("searchHeader.php");
            }
            elseif((similar_text($_SERVER['REQUEST_URI'],'searchDatabase.php'))==18){
                echo '<script>alert("Search is empty. Please enter something to search.")</script>';
                echo '<script>history.back()</script>';
            } 
            ?>
            <H1>Actors</H1>
            <?php include("search_actors.php"); $total += $num_rows;?>
            <H1>Movies</H1>
            <?php include("search_movies.php"); $total += $num_rows;?>
        </div>
        <?php if($total == 1){
                if(!(empty($soloActorResult))){
                    header('Location: actorInfo.php?ID='.htmlentities($soloActorResult));
                }
                elseif(!(empty($soloMovieResult))){
                    header('Location: movieInfo.php?ID='.htmlentities($soloMovieResult));                     
                }
            }
            
        ?>
    </body> 

</html> 
