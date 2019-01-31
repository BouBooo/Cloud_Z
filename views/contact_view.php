<!DOCTYPE html>
<html>
<head>
    <?php include_once('views/includes/head.php'); ?>
    <title><?= ucfirst($page) ?> - NiceTry</title>
</head>

<body>

<?php include_once('views/includes/header.php'); ?>

    <h1>Contact</h1>


<form action="../controllers/contact_controllers.php" method="post">
    <div>
        <label for="name">Nom :</label>
        <input type="text" id="name" name="user_name">
    </div>
    <div>
        <label for="mail">e-mail :</label>
        <input type="email" id="mail" name="user_mail">
    </div>
    <div>
        <label for="msg">Message :</label>
        <textarea id="msg" name="user_message"></textarea>
    </div>
    <div class="button">
        <button type="submit">Envoyer le message</button>
    </div>
</form>


<?php include_once('views/includes/footer.php'); ?>

</body>
</html>