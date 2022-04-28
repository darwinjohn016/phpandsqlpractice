<?php
    session_start();
    require('database.php');


    class Model extends Database{

        // Select SQL method
        protected function loginUser($username,$password){

            $stmt = $this->connect()->prepare("SELECT * FROM practice WHERE username = ? AND password = ?");

            $stmt->execute([$username,$password]);

            $row = $stmt->fetchAll();

            $_SESSION['username'] = $row[0]['username'];

            header('Location: index.php');

        }
        
        
    }

    class Control extends Model{

        private $username;
        private $password;

        public function __construct($username,$password){
            $this->username = $username;
            $this->password = $password;
        }


        // Bago makapaginsert sa database dapat ang result ng variable result ay true else di siya
        // magiinsert sa database
        public function checkLoginUser(){

            $result = true;

            if($this->emptyUsername()== false){
                $result = false;
                echo '<script>alert("Empty Username")</script>';
            }

            if($this->emptyPassword()== false){
                $result = false;
                echo '<script>alert("Empty Password")</script>';
            }

            if($result == true){
                $this->loginUser($this->username,$this->password);
                echo '<script>alert("Success")</script>';
            }
        
        }

        // Ichecheck kung walang laman yung username if walang laman return ay false
        private function emptyUsername(){
            $result = true;
            if(empty($this->username)){
                $result = false;
            }
            else{
                $result = true;
            }

            return $result;
        }

        // Ichecheck kung walang laman yung password if walang laman return ay false
        private function emptyPassword(){
            $result = true;
            if(empty($this->password)){
                $result = false;
            }
            else{
                $result = true;
            }

            return $result;
        }

    }


    // Send yung data na ininput mo sa textfield papuntang server and to the database
    if(isset($_POST['submit'])){
        
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $data = new Control($username,$password);
        $data -> checkLoginUser();
        
    }

    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/global.css">
</head>

    <style>

        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        form{
            width: min(90%,300px);
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem;
            background-color: #ecebeb;
            box-shadow: 1px 1px 5px rgba(0,0,0,0.2),
            -1px -1px 5px rgba(255,255,255,0.2);
        }

        form h1{
            margin-bottom: 2rem;
        }

        .form-bx{
            display: flex;
            flex-direction: column;
            gap: .5rem;
            margin-bottom: 1rem;
        }

        .submit-bx{
            margin-top: 2rem;
        }

        .submit-bx button{
            background-color: #00754B;
            color: white;
        }

    </style>

<body>

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

        <h1>Login</h1>

        <div class="form-bx">
            <label for="">Username</label>
            <input type="text" name="username">
        </div>
        
        <div class="form-bx">
            <label for="">Password</label>
            <input type="password" name="password">
        </div>

        <div class="submit-bx">
            <button type="submit" name="submit">Submit</button>
        </div>

    </form>

    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
        }
    </script>
    
</body>
</html>