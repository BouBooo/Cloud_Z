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
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=messagerie">Messagerie</a>
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
?>






<style>

/*message*/
.message-body{
    display: block;
    height: 600px;
    width: 70%;
    margin:0px auto;
    border:1px solid #ccc;
}
.message-left{
    display: block;
    height: 100%;
    width: 30%;
    float: left;
    overflow-y: scroll;
    border-right: 1px solid #ccc;
}
.message-right{
    display: block;
    height: 100%;
    width: 70%;
    float: left;
}
.message-left ul{
    list-style: none;
    margin: 0;
    padding: 0;
    width: 100%;
}
.message-left ul a{
    text-decoration: none;
}
.message-left ul a li{
    padding: 5px;
    border-bottom: 1px solid #ccc;
    font-weight: bold;
    color: black;
}
.message-left ul a li img{
    height: 50px;
    width: 50px;
}
.message-left ul a li:hover{
    background: #EBEDF5;
}
.message-left ul a li.active{
    background: #6B83B3;
}
.message-right .display-message{
    display: block;
    height: 80%;
    width: 100%;
    border-bottom: 1px solid #ccc;
    overflow-y:scroll;
}
.message-right .send-message{
    height: 20%;
    background: #eee;
    padding: 10px;
}
.display-message .message{
    min-height: 60px;
    padding: 5px;
}
.message .img-con{
    width: 10%;
    float: left;
    height: inherit;
}
.message .img-con > img{
    height: 50px;
    width: 50px;
}
.message .text-con{
    width: 90%;
    float: left;
    height: inherit;
}
hr{
    margin-top: 0;
    margin-bottom: 0;
    border-top:1px solid #ccc;
}




/* Bubbles */

section {
  max-width: 450px;
  margin: 50px auto;
  div {
    max-width: 255px;
    word-wrap: break-word;
    margin-bottom: 20px;
    line-height: 24px;
  }
}

.clear {
  clear: both
}

.from-me {
  position: relative;
  padding: 10px 20px;
  color: white;
  background: #0B93F6;
  border-radius: 25px;
  float: right;
  &:before {
    content: "";
    position: absolute;
    z-index: -1;
    bottom: -2px;
    right: -7px;
    height: 20px;
    border-right: 20px solid #0B93F6;
    border-bottom-left-radius: 16px 14px;
    -webkit-transform: translate(0, -2px);
  }
  &:after {
    content: "";
    position: absolute;
    z-index: 1;
    bottom: -2px;
    right: -56px;
    width: 26px;
    height: 20px;
    background: white;
    border-bottom-left-radius: 10px;
    -webkit-transform: translate(-30px, -2px);
  }
}

.from-them {
  position: relative;
  padding:10px 20px;
  background: #E5E5EA;
  border-radius: 25px;
  color: black;
  float: left;
  &:before {
    content: "";
    position: absolute;
    z-index: 2;
    bottom: -2px;
    left: -7px;
    height: 20px;
    border-left: 20px solid #E5E5EA;
    border-bottom-right-radius: 16px 14px;
    -webkit-transform: translate(0, -2px);
  }
  &:after {
    content: "";
    position: absolute;
    z-index: 3;
    bottom: -2px;
    left: 4px;
    width: 26px;
    height: 20px;
    background: white;
    border-bottom-right-radius: 10px;
    -webkit-transform: translate(-30px, -2px);
  }
}


.infos  {
    font-size: 10px;
}



</style>