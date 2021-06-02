<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=myDB','root','root');
    }catch(PDOException $e){
        die('Connection Error : '. $e->getMessage());
    }
?>
