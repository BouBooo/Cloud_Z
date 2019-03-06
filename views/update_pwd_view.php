<style>
        @import url(https://fonts.googleapis.com/css?family=Raleway|Varela+Round|Coda);
        @import url(http://weloveiconfonts.com/api/?family=entypo);

        [class*="entypo-"]:before {
        font-family: 'entypo', sans-serif;
        }

        .title-pen {
        color: #333;
        font-family: "Coda", sans-serif;
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

        .user-profile {
        padding-top: 1em;
        margin: auto;
            width: 30em; 
        height: 11em;
        background: #fff;
        border-radius: .3em;
        }
</style>



<br>
<h1 class="title-pen"> User Profile <span><?= $user_name; ?></span></h1>

<div class="col-md">
  
  <form method="POST" action="" enctype="multipart/form-data">       
  <table style="margin-top:2%; margin-left:10%; width:80%" class="table table-bordered table-dark">
  <tr>
      <td>
          <label>Current password : </label>
      </td>
      <td>
        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Current password" value="">
      </tr>
  </tr>
  <tr>
  <tr>
      <td>
          <label>New password : </label>
      </td>
      <td>
        <input type="password" class="form-control" id="mdp2" name="mdp2" placeholder="New password" >
      </tr>
  </tr>
  <tr>
      <td>
          <label>Confirm new password : </label>
      </td>
      <td>
        <input type="password" class="form-control" id="mdp3" name="mdp3" placeholder="Confirm new password" >
      </tr>
  </tr>
  <tr>
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
