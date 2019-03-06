<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    $db = Database::connect();
}


?>   



