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

        //This is the page to verify the username and password.
        $username = $_POST['txt_username'];
        $password = $_POST['txt_password'];

        //Now that we have the username and password, we have to verify that they belong to someone
        $sql = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password .  "';";

        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            echo "<script>sessionStorage.setItem('usernameStored','" . $username . "');</script>";
            echo "<script>location.href='clicker.html';</script>";
            
        }
        else
        {
            echo "<script>sessionStorage.setItem('errorType', 'Invalid Username or Password');</script>";
            echo "<script>location.href='index.html';</script>";
        }

    ?>
</body>