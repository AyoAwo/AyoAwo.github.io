<?php 
        $db_host = 'mysql.cs.nott.ac.uk';
        $db_name = 'psyaa21_COMP1004';
        $db_user = 'psyaa21_COMP1004';
        $db_pass = 'Winter1004'; 
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name); 
        if ($conn->connect_errno) die("failed to connect to database\n</body>\n</html>"); 
        $sql="SELECT(SELECT COUNT(*) FROM Movie),(SELECT COUNT(*) FROM Actor)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($numMovies, $numActors);
        $stmt->fetch();
        $stmt->close();
        ?>
<html>
    <head></head>
    <body>
        <H1> Welcome to Ayo's Movie Database*! </H1>
        <H4>To view/add actors or movies, head tp their pages by using the sidebar navigator which can be accessed by the menu button at the top right side of the page.</H4>
        <br>    
        <H4>The search bar above can be used to search the entire database, but you can also use the selecter to search specifically for actors or movies.</H4>
        <br>
        <H5>There are currently <strong><span style="color:#FFC800"><?php echo htmlentities($numMovies);?> actors</span></strong> in the database.</H5>
        <br>
        <H5>There are currently <strong><span style="color:#FFC800"><?php echo htmlentities($numMovies);?> movies</span></strong> in the database.</H5>
    </body> 

</html> 