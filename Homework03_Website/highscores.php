<body>
    <?php
        $servername = 'localhost';
        $db_username = 'ndyk';
        $db_password = 'password';
        $dbname = 'clickCounter';

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if ($conn->connect_error) 
        {
            die('Connection Failed: '. $conn->connect_error);
        }
        else
        {
            //echo'GOOD CONNECTION';
        }

        $sql = 'SELECT * FROM scores ORDER BY -totalClicks';

        $results = $conn->query($sql);

        $i = 0;
        $highscores = "<tr><th>Username</th><th>Score</th><th>Clicks Per Second</th><th>Date</th></tr>";

        echo "<p>" . $results->num_rows . "</p>";

        if ($results->num_rows > 0)
        {
            echo "numrows";
            while($row = $results->fetch_assoc())
            {
                echo $i;
                echo $row["username"];
                $highscores .= "<tr><td>" . $row['username'] . "</td><td>" . $row['totalClicks'] . "</td><td>" . $row['clicksPerSecond'] . "</td><td>" . $row['date'] . "</td></tr>";
                $i += 1;
                if ($i >= 10)
                {
                    break;
                }
            }
        }

        echo "<script>sessionStorage.setItem('highscores','" . $highscores ."');</script>";
        echo "<script>location.href = 'highscores.html'</script>";
    ?>
</body>