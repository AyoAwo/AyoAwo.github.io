<html>
    <head>
        <?php include('imports.php')?>
    </head>
    <body>
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
        $stmt->bind_result($Genre);
        ?>
    <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Search Via Genres</button>
            <ul class="dropdown-menu dropdown-menu-end">
        <?php
        while($stmt->fetch()){ 
            echo "<li><a class='dropdown-item' style='text-transform:capitalize' href='search_movies.php?Genre=$Genre'>";
            echo htmlentities($Genre); 
            echo "</li>"; 
        }
        $stmt->close();
        
    ?>
    </ul>
    </body>
</html>