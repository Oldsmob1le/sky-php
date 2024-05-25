<?php
    try{
        $conn = new PDO ("mysql:host=localhost;dbname=skybridge",'root','');
    }catch(PDOException $e){
        echo $e;
    }
?>