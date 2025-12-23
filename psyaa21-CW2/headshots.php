<?php 
    $db_host = 'mysql.cs.nott.ac.uk';
    $db_name = 'psyaa21_COMP1004';
    $db_user = 'psyaa21_COMP1004';
    $db_pass = 'Winter1004'; 
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
    if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
    $sql="SELECT actID,actName FROM Actor ORDER BY actID DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($ID, $Name);
    $num_rows = 0;
    $i=0;
?>


                <div class="carousel-inner">
                    <?php 
                    while($stmt->fetch()){ 
                        $filename = "assets/headshots/actor".$ID.".png";
                        if(file_exists($filename) && ($num_rows < 5)){
                            echo '<div class="carousel-item';
                            if($num_rows < 1){ echo ' active';}
                            echo '" data-bs-interval="4800" >';
                            echo '<div class="d-flex justify-content-center">';
                            echo '<a href="actorInfo.php?ID='.htmlentities($ID).'">';
                            echo '<img src="'.htmlentities($filename).'" class="d-block w-100" style="width:200px;height:400px;" alt="'.htmlentities($Name).'"></a>';
                            echo '</div>';
                            echo '<div class="carousel-caption d-none d-md-block">
                                        <h5 style="color:#fff;background:black;opacity:80%;"><strong>'.htmlentities($Name).'</strong></h5>
                                    </div>';
                            echo '</div>';
                            $num_rows += 1;
                        }
                        
                    }
                    $stmt->close();
                    if($num_rows < 2){
                        while($num_rows < 3){
                            echo '<div class="carousel-item';
                            if($num_rows < 1){ echo ' active';}
                            echo '" data-bs-interval="4800">';
                            echo '<div class="d-flex justify-content-center">';
                            echo '<a href="actors.html">';
                            echo '<img src="assets/headshots/headshot.png" class="d-block w-50" style="width:200px;height:400px;" alt="Headshot Template">';
                            echo '</div>';
                            echo '<div class="carousel-caption d-none d-md-block">
                                        <h5 style="color:#fff;background:black;opacity:80%;"><strong>Template Headshot</strong></h5>
                                    </div>';
                            echo '</div>';
                            $num_rows += 1;
                        }
                    } 
                    
                    ?>
                </div>  
                <div class="carousel-indicators">
                    <?php 
                        while($i<$num_rows){
                            echo '<button type="button" data-bs-target="#actorCarousel" data-bs-slide-to="'.$i.'" class="';
                            if($i == 0){echo 'active" aria-current="true"';}
                            echo ' aria-label="Slide '.($i+1).'"></button>';
                            $i += 1;
                        }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#actorCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#actorCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>