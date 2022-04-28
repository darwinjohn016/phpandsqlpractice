<?php

    class Database{
        protected function connect(){
            try{
                $username = 'root';
                $password = '';
                $pdo = new PDO('mysql:host=localhost;dbname=practice',$username,$password);
                echo 'Success';
                return $pdo;
            }

            catch(PDOException $e){
                $e->getMessage();
            }
        }
    }

?>
