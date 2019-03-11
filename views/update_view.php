<style>
        @import url(https://fonts.googleapis.com/css?family=Raleway|Varela+Round|Coda);
        @import url(http://weloveiconfonts.com/api/?family=entypo);

        [class*="entypo-"]:before {
        font-family: 'entypo', sans-serif;
        }

        body  {
            background-color: #76B12E;

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

<div class="col-md">
  
  <form method="POST" action="" enctype="multipart/form-data">       
  <table style="margin-top:2%; margin-left:10%; width:80%" class="table table-bordered table-dark">

  <tr>
      <td>
          <label for="name">Username : </label>
      </td>
      <td>
          <input class="form-control form-control-sm" type="text" name="name" value="<?= $user_name; ?>"/>
      </tr>
  </tr>
  <tr>
      <td>
          <label for="email">Email : </label>
      </td>
      <td>
          <input class="form-control form-control-sm" name="email" id="email" value="<?= $user_email; ?>">
      </td>
  </tr>
  <tr>
      <td>
          <label for="desc">Description : </label>
      </td>
      <td>
          <input class="form-control form-control-sm" type="text" name="desc" id="desc" value="<?= $user_desc; ?>"/>
      </tr>
  </tr>
  <tr>
      <td>
          <label for="img">Profile img : </label>
          <br>
          <form method="POST" action="" enctype="multipart/form-data">   
            <input type="submit" class="btn btn-primary btn-xl" name="delete_picture" value="Remove current picture"/>
          </form>
      </td>
      <td>
          <input type="file" name="img"/>
          <br>
          <br>
          <input disabled class="form-control form-control-sm" type="text" name="current_img" value="current profile img : <?= $user_img; ?>"/>
      </tr>
  </tr>
  <tr>
      <td>
          <label>Password : </label>
      </td>
      <td>
        <a href="index.php?page=update_pwd" class="btn btn-primary btn-xl">Change password</a> 
      </td>
  </tr>
  <tr>
      <td></td>
      <td>
      <br>
      <input type="submit" value="Update" name="update" class="btn btn-primary btn-xl"/> 
      </td>
  </tr>
  </table>
  <div class="row">
  <div class="col-sm">
      
    </div>
    <div class="col-sm">
        <span style="color:red"> <?= $updateError; ?> </span>
        <span style="color:green"> <?= $updateSuccess; ?> </span>
    </div>
    <div class="col-sm">
      
    </div>
</div>
</div>
  </form>


    </div>
