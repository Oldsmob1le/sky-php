<?php
    try{
        $conn = new PDO ("mysql:host=localhost;dbname=skyphp",'root','');
    }catch(PDOException $e){
        echo $e;
    }
?>