<?php

    include_once '_classes/database.php';
    include_once '_functions/functions.php';
    include_once 'views/includes/head.php';

    if(!empty($_SESSION))
    {
        include_once 'views/includes/nav.php';
    }



    // Définition de la page courante
    if(isset($_GET['page']) AND !empty($_GET['page']))
    {
        trim(strtolower($page = $_GET['page']));
    }
    else
    {
        $page = 'home';
    }

$allPages = scandir('controllers/');

if(in_array($page.'_controller.php', $allPages)) 
{
    // Inclusion de la page
    include_once 'controllers/'.$page.'_controller.php';
    include_once 'models/'.$page.'_model.php';
    include_once 'views/'.$page.'_view.php';
}
else
{
    // Error
    $page = 'error404';
    include_once 'controllers/'.$page.'_controller.php';
    include_once 'models/'.$page.'_model.php';
    include_once 'views/'.$page.'_view.php';
}

?>