
<div class="container">

    <h1 align="center">Send a message</h1>

    <div  align="center">
        <a class="btn btn-info" href="index.php?page=messagerie">Back</a>
    </div>   


<form method="POST" action="">       
<table style="margin-top:2%; margin-left:10%; width:80%" class="table table-striped table-dark p-5">

<tr>
  <td>
      <label for="destinataire">For : </label>
  </td>
  <td>
      <select class="form-control form-control-sm" name="destinataire" id="destinataire">
      <?php
      if(isset($response))
      {
        echo '<option value="'.$response.'">'.$response.'</option>';
      }
      else
      {
        while($data = $getUsers->fetch())
        {
            echo '<option value="'.$data["email"].'">'.$data["email"].'</option>';
        }
      }
        ?>
      </select>
  </td>
</tr>
<tr>
  <td>
      <label for="message">Message : </label>
  </td>
  <td>
      <textarea placeholder="Your message" name="message">Hi !
      </textarea>
  </tr>
</tr>
<tr>
  <td></td>
  <td>
  <br>
  <input type="submit" value="Send" name="send_message" class="btn btn-primary btn-xl"/> 
  </td>
</tr>
</table>

<div align="center">
<br>
    <?= $message_error; ?>
    <?= $message_success; ?>
</div>

</div>