
        <div class="input-group mb-3">
            <input type="name" class="form-control" name="title" id="Title" aria-describedby="TitleInput" placeholder="Title">
        </div>
        <label for="Genre" class="form-label">Select a Genre or enter a new one</label>
        <div class="input-group mb-3">
            <input type="name" class="form-control" name="genre" id="Genre" placeholder="Genre">
            <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" value="genres">Genres</button>
            <ul class="dropdown-menu dropdown-menu-end">
                <?php
                    $db_host = 'mysql.cs.nott.ac.uk';
                    $db_name = 'psyaa21_COMP1004';
                    $db_user = 'psyaa21_COMP1004';
                    $db_pass = 'Winter1004'; 
                    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
                    if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
                    $sql="SELECT DISTINCT mvGenre FROM Movie"; 
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(); 
                    $stmt->bind_result($formGenres);
                    ?>
                    <?php
                    while($stmt->fetch()){ 
                        echo '<li><a class="dropdown-item" style="text-transform:capitalize" href="javascript:fillField(';
                        echo "'Genre','".htmlentities($formGenres)."'".')">'.htmlentities($formGenres).'</a></li>';
                    }
                    $stmt->close();
                ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="javascript:fillField('Genre','')">Clear</a></li>
            </ul>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="addon-wrapping">£</span>
            <input min="0.00" max="50.00" step="0.01" type="number" id="Price" name="price" placeholder="Price" class="form-control" />
            <span class="input-group-text" id="addon-wrapping">&#128198</span>
            <input min="1888" max="2023" type="number" id="Year" name="year" placeholder="Year" class="form-control" />
        </div>         
