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

        $clicks = $_GET['totalClicks'];
        $clicksPerSec = $_GET['clickPerSec'];
        $user  = $_GET['username'];

        echo $user . " " . $clicks . " " . $clicksPerSec;

        $sql = "INSERT INTO scores (username, totalClicks, clicksPerSecond) VALUES ('" . $user . "','" . $clicks . "','" . $clicksPerSec ."');";

        if ($conn->query($sql) == TRUE)
        {
            echo "Success!";
        }
        else
        {
            echo "ERROR";
        }
    ?>
</body>