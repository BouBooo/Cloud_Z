<?php
session_start();

$file_exist = false;
$uploadError = "";
$uploadSuccess = "";

//var_dump($_SESSION);
if(!empty($_SESSION['id']) && $_SESSION['id'] > 0)
{
    if(isset($_POST['upload']))
    {
        if(!empty($_FILES['fichier']))
        {
            $file_name = $_FILES['fichier']['name'];
            $file_extension =strrchr($file_name, ".");
            $file_tmp_name = $_FILES['fichier']['tmp_name'];
            $file_dest = 'files/'.$file_name;

            $valid_extension = array('.pdf', '.jpg', '.jpeg', '.gif', '.png', '.PNG');

            if(in_array($file_extension, $valid_extension))
            {
                if(move_uploaded_file($file_tmp_name, $file_dest))
                {
                    if($_FILES['fichier']['error'] == 0)
                    {
                        $db = Database::connect();
                        $add_file = $db->prepare("SELECT * FROM files WHERE member_id = ?");
                        $add_file->execute(array($_SESSION['id']));
                        var_dump($_FILES);
                        foreach($add_file as $file)
                        {
                            $file_type = $_FILES['fichier']['type'];
                            $file_size = $_FILES['fichier']['size']/1000;   // File size (octal to ko)
                            $file_name = $_FILES['fichier']['name'];
                            if($file_name != $file['name'])
                            {
                                $file_exist = false;
                            }
                            else
                            {
                                $file_exist = true;
                            }
                        }
                        if($file_exist == false)
                        {
                            $add_file = $db->prepare("INSERT INTO files (name,access,size,type,path, member_id) values (?,?,?,?,?,?)");
                            $add_file->execute(array($file_name,$_POST['access'],$file_size,$file_type,$file_tmp_name,$_SESSION['id']));
                            $uploadSuccess = "<div class='alert alert-success'>Votre fichier a été upload avec succès</div>";
                        }
                        else
                        {
                            $uploadError = "<div class='alert alert-danger'>Un fichier similaire existe déjà pour cet user</div>";
                        }
                        
                        
                    }
                    else
                    {
                        $uploadError = "<div class='alert alert-danger'>Une erreure est survenue lors de l'upload du fichier</div>";
                    }
                }
                else
                {
                    $uploadError = "<div class='alert alert-danger'>Une erreure est survenue lors de l'upload du fichier</div>";
                }
            }
            else
            {
                $uploadError =  "<div class='alert alert-danger'>Seuls les fichiers de type .pdf, .jpeg, .jpg et .gif sont autorisés.</div>";
            }
        }
        else
        {
            $uploadError = "<div class='alert alert-danger'>Veuillez choisir un fichier</div>";
        }
    }
    else
    {
        $uploadError = "";
    }
}
else
{
    //header('Location: connexion.php');
}


?>


