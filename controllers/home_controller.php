<?php

if(empty($_SESSION['id']) && $_SESSION['id'] == 0)
{
    header('Location: index.php?page=connexion');
}

?>