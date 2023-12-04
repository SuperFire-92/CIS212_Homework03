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

        if (isset($_POST['registerButton']))
        {
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];
            $fName = $_POST['txt_firstName'];
            $lname = $_POST['txt_lastName'];

            $sql = "SELECT username FROM users WHERE username = '".$username."';";

            $result = $conn->query($sql);

            if ($result->num_rows <= 0 && $username != "")
            {
                $sql = "INSERT INTO users VALUES ('" . $username . "','" . $password . "','" . $fName . "','" . $lname . "');";
                if ($conn->query($sql) == TRUE)
                {
                    echo "<script>location.href='index.html'</script>";
                }
                else
                {
                    echo "<script>sessionStorage.setItem('errorType', 'InnerFail');</script>";
                    echo "<script>location.href='sign_up.html'</script>";
                }
            }
            else
            {
                if ($username != "")
                {
                    echo "<script>sessionStorage.setItem('errorType', 'UsernameTaken');</script>";
                }
                else
                {
                    echo "<script>sessionStorage.setItem('errorType', 'NoUsername');</script>";
                }

                echo "<script>location.href='sign_up.html'</script>";
            }
        }
    ?>  
</body>
