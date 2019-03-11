<style>


        [class*="entypo-"]:before {
        font-family: 'entypo', sans-serif;
        }

        .title-pen {
        color: #333;
        font-family: "Coda", sans-serif;
        text-align: center;
        }
        .title-pen span {
        color: #55acee;
        }

        .user-profile {
        padding-top: 1em;
        margin: auto;
            width: 30em; 
        height: 11em;
        background: #fff;
        border-radius: .3em;
        }

        .user-profile  .username {
        margin: auto;
        margin-top: -4.40em;
        margin-left: 5.80em;
        color: #658585;
        font-size: 1.53em;
        font-family: "Coda", sans-serif;
        font-weight: bold;
        }
        .user-profile  .bio {
        margin: auto;
        display: inline-block;
        margin-left: 10.43em;
        color: #e76043; 
        font-size: .87em;
        font-family: "varela round", sans-serif;
        }
        .user-profile > .description {
        margin: auto;
        margin-top: 1.35em;
        margin-right: 4.43em;
        width: 14em;
        color: #c0c5c5; 
        font-size: .87em;
        font-family: "varela round", sans-serif;
        }
        .user-profile > img.avatar {
            padding: .7em;
        margin-left: .3em;
        margin-top: .3em;
        height: 6.23em;
        width: 6.23em;
        border-radius: 18em;
        }

        .user-profile ul.data {
            margin: 2em auto;
            height: 3.70em;
        background: #4eb6b6;
        text-align: center;
        border-radius: 0 0 .3em .3em;
        }
        .user-profile li {
            margin: 0 auto;
        padding: 1.30em; 
        width: 33.33334%;
        display: table-cell;
        text-align: center;
        }

        .user-profile span {
            font-family: "varela round", sans-serif;
            color: #e3eeee;
        white-space: nowrap;
        font-size: 1.27em;
        font-weight: bold;
        }
        .user-profile span:hover {
        color: #daebea;
        }

        footer > h1 {
        display: block;
        text-align: center;
        clear: both;
        font-family: "Coda", sans-serif;
        color: #343f3d;
        line-height: 6;
        font-size: 1.6em;
        }
        footer > h1 a {
        text-decoration: none;
        color: #ea4c89;
        }


</style>


<br>
<h1 class="title-pen"> User Profile <span><?= $user_name; ?></span></h1>
<div class="user-profile">
<?php
    $db = Database::connect();
    $user = $db->prepare('SELECT * FROM membres WHERE id = ?');
    $user->execute(array($_SESSION['id']));
    $userinfo = $user->fetch();

    if(!empty($userinfo['img']))
    {
    ?>
    <img src="membres/img/<?php echo $userinfo['img']; ?>" width="120" style="padding:10px">
    <?php
    }
    else
    {
        echo "<img class='avatar' src='https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTF_erFD1SeUnxEpvFjzBCCDxLvf-wlh9ZuPMqi02qGnyyBtPWdE-3KoH3s' alt='Ash' />";
    }
    ?>
    <div class="username"><?= $user_email; ?></div>
  <div class="bio">
    <?= $user_rank; ?>
  </div>
    <div class="description">
        <?= $user_desc; ?>
  </div>
</div>