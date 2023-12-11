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

        $type = $_GET['type'];

        //Default sort, highest to lowest
        if ($type == 'default')
        {
            $sql = 'SELECT * FROM scores ORDER BY -totalClicks';
        }
        //Special sort, only the user
        else if ($type == 'user')
        {
            $user = $_GET['user'];

            $sql = "SELECT * FROM scores WHERE username = '" . $user . "' ORDER BY -totalClicks";
        }
        //Special sort, only scores of prime numbers
        else if ($type == "prime")
        {
            $sql = "SELECT * FROM scores ORDER BY -totalClicks";
        }

        

        $results = $conn->query($sql);

        

        $i = 0;
        $highscores = "<tr><th>Username</th><th>Score</th><th>Clicks Per Second</th><th>Date</th></tr>";

        echo "<p>" . $results->num_rows . "</p>";

        if ($results->num_rows > 0)
        {
            echo "numrows";
            while($row = $results->fetch_assoc())
            {
                //Custom code to accomodate for seeing scores that are prime numbers
                if ($type == "prime")
                {
                    if (isPrime($row["totalClicks"]))
                    {
                        $highscores .= "<tr><td>" . $row['username'] . "</td><td>" . $row['totalClicks'] . "</td><td>" . $row['clicksPerSecond'] . "</td><td>" . $row['date'] . "</td></tr>";
                        $i += 1;
                        if ($i >= 10)
                        {
                            break;
                        }
                    }
                }
                else
                {
                    $highscores .= "<tr><td>" . $row['username'] . "</td><td>" . $row['totalClicks'] . "</td><td>" . $row['clicksPerSecond'] . "</td><td>" . $row['date'] . "</td></tr>";
                    $i += 1;
                    if ($i >= 10)
                    {
                        break;
                    }
                }
                
                
            }
        }

        echo "<script>sessionStorage.setItem('highscores','" . $highscores ."');</script>";
        echo "<script>location.href = 'highscores.html'</script>";

        function isPrime($num)
        {
            $isPrime = true;
            for ($i = 2; $i < $num; $i++)
            {
                if ($num % $i == 0)
                {
                    $isPrime = false;
                }
            }
            return $isPrime;
        }
    ?>
</body>