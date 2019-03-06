<?php
if(!empty($_SESSION))
    {
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=profil">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=update">Edit profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=files">My files</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=search">Search</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=upload">Upload</a>
      </li>

      <?php    
            if($_SESSION['admin'] == 1)
            {   
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="index.php?page=admin">Admin space</a>';
              echo '</li>';
            }
      ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=disconnect">Disconnect</a>
      </li>
    </ul>

  </div>
</nav>

<?php
    }
    else
    {
        header('Location: index.php?page=connexion');
    }