<?php 

    class DBManager{

        private static string $host = "localhost";
        private static string  $database = "ByRote";
        private static string $username = "root";
        private static string $password = "zzzz22000066";

        private static function connectToDB(){

            $conn = new mysqli(DBManager::$host, DBManager::$username, DBManager::$password, DBManager::$database);

            if($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }

            return $conn;
        }

        private static function setUpDB(){

            $conn = DBManager::connectToDB();
            $query = 
            "CREATE TABLE IF NOT EXISTS users (
                id INT(6) NOT NULL AUTO_INCREMENT,
                username VARCHAR(30) NOT NULL,
                password VARCHAR(50) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            );";

            $query2 = "CREATE TABLE tests (
                id INT NOT NULL AUTO_INCREMENT,
                title VARCHAR(100) NOT NULL,
                content JSON NOT NULL,
                user_id INT,
                PRIMARY KEY (id),
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            );";

            if ($conn->query($query2) === TRUE)
            {
                echo "Table has been created.";
            }
            else
            {
                echo "Erorr" . $conn->error;
            }

            if ($conn->query($query) === TRUE)
            {
                echo "Table has been created.";
            }
            else
            {
                echo "Erorr" . $conn->error;
            }

            $conn->close();
        }

        public static function createUser($fullname, $password, $confirm_password)
        {
            $db = DBManager::connectToDB();
            
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $error = '';

        if($query = $db->prepare("SELECT * FROM users WHERE username = ?")) {
            $query->bind_param('s', $fullname);
            $query->execute();
            $query->store_result();
            if ($query->num_rows > 0) {
                $error .= '<p class="error">The login is already registered!</p>';
            } else {
                if (strlen($password ) < 6) {
                    $error .= '<p class="error">Password must have atleast 6 characters.</p>';
                }

                if (empty($confirm_password)) {
                    $error .= '<p class="error">Please enter confirm password.</p>';
                } else {
                    if (empty($error) && ($password != $confirm_password)) {
                        $error .= '<p class="error">Password did not match.</p>';
                    }
                }
                if (empty($error) ) {
                    $insertQuery = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?);");
                    $insertQuery->bind_param("ss", $fullname, $password_hash);
                    $result = $insertQuery->execute();
                    if ($result) {
                        return TRUE;
                    } else {
                        $error .= '<p class="error">Something went wrong!</p>';
                    }
                    $insertQuery->close();
                }
            }
        }
        $query->close();
        mysqli_close($db);
            
        return $error;
            
        }
    }

?>