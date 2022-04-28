<?php

    require('database.php');

    class Model extends Database{

        // Insert SQL method
        protected function insertUser($username,$password){

            $stmt = $this->connect()->prepare("INSERT INTO practice (username,password) VALUES(? , ?)");

            $stmt->execute([$username,$password]);

        }

        // Select SQL method
        protected function sameUser($username){ 

            

            $stmt = $this->connect()->prepare("SELECT * FROM practice WHERE username = ? ");

            $stmt->execute([$username]);

            

            $result = true;
            if(!empty($stmt->fetch())){ 
                $result = false;
            }

            return $result;  

        }
        

    }
  

    class Control extends Model{

        private $username;
        private $password;

        public function __construct($username,$password){ //constructor dars dara
            $this->username = $username; // $this->username = dars;
            $this->password = $password; // $this->password = dara;
        }


        // Bago makapaginsert sa database dapat ang result ng variable result ay true else di siya
        // magiinsert sa database
        public function insertToUser(){


            $result = true;

            if($this->emptyUsername()== false){ // true = false

                
                $result = false;
                echo '<script>alert("Empty Username")</script>';//true
            }

            if($this->sameUser($this->username) == false){  //true
                $result = false;
                echo '<script>alert("Registration Failed")</script>';
            }

            if($this->emptyPassword()== false){ //false
                $result = false;
                echo '<script>alert("Empty Password")</script>';
            }

            if($result == true){
                $this->insertUser($this->username,$this->password);
                
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

            return $result; // true 
        }

        // Ichecheck kung may kaparehas na user if meron return ay false
        // private function sameUsername(){
        //     $result = true;
        //     if($this->sameUser($this->username) == false){ //dars $this->sameUser(dars)
        //         // $result = false;
        //     }
        //     else{
        //         $result = true;
        //     }

        //     return $result;

            
        // }

        // Ichecheck kung walang laman yung password if walang laman return ay false
        private function emptyPassword(){
            $result = true;
            if(empty($this->password)){
                $result = false;
            }
            else{
                $result = true;
            }

            return $result; // true
        }

    }

    // Send yung data na ininput mo sa textfield papuntang server and to the database
    if(isset($_POST['submit'])){
        
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $data = new Control($username,$password); 

        // class Control
        // construct__($username,$password)

        // $this->username : Username
        // username : dars

        

        $data -> insertToUser();

        

        
        
        
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
    
    <form action="registration.php" method="post">

        <h1>Registration</h1>

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

    <script src="js/index.js"></script>

</body>
</html>