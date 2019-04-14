<?php
session_start();

$all_files = true;
$priv = false;
$limit_fixed = false;
$key_error = "";

$db = Database::connect();
$req_files = $db->prepare('SELECT f.name, m.email FROM files f JOIN membres m ON f.member_id = m.id WHERE f.access = "public" ORDER BY f.id DESC LIMIT 10');
$req_files->execute();



if(!empty($_POST['private_file']))
{
    $private_key = $_POST['private_key']; 
    if (strlen($private_key) < 12 || strlen($private_key) > 12)
    {
        $key_error = "<span class='alert alert-danger'>Private key must have 12 characters</span>";
        $all_files = true;
        $priv = false;
    }
    else
    {
        $all_files = false;
        $priv = true;
        $req_files = $db->prepare('SELECT f.name, m.email FROM files f JOIN membres m ON f.member_id = m.id WHERE f.access = "private" AND f.file_key = ?');
        $req_files->execute(array($private_key));

        // Check if key match with a private file
        $count = $req_files->rowCount();

    }
}


if(!empty($_POST['limit']))
{
    $limit = $_POST['limit'];
    $all_files = false;
    $limit_fixed = true;

    $req_files = $db->prepare('SELECT f.name, m.email FROM files f JOIN membres m ON f.member_id = m.id WHERE f.access = "public" ORDER BY f.id DESC LIMIT '.$limit);
    $req_files->execute();

}



?>