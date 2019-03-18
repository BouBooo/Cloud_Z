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

        body  {
            background-color: #76B12E;

        }

</style>


<body>

<div class="col-md">
    <br>
        <h1 class="title-pen">Upload files</h1>
  
  <form method="POST" action="" enctype="multipart/form-data">       
  <table style="margin-top:2%; margin-left:10%; width:80%" class="table table-striped table-dark p-5">

  <tr>
      <td>
          <label for="fichier">File : </label>
      </td>
      <td>
          <input class="btn text-white" type="file" name="fichier" />
      </tr>
  </tr>
  <tr>
      <td>
          <label for="access">Accessibility : </label>
      </td>
      <td>
          <select class="form-control form-control-sm" name="access" id="access">
              <option value="public">Public</option>
              <option value="private">Privé</option>
          </select>
      </td>
  </tr>
  <tr>
      <td></td>
      <td>
      <br>
      <input type="submit" value="Upload" name="upload" class="btn btn-primary btn-xl"/> 
      </td>
  </tr>
  </table>
  <div class="row">
  <div class="col-sm">
      
    </div>
    <div class="col-sm">
        <span style="color:red"> <?= $uploadError; ?> </span>
        <span style="color:green"> <?= $uploadSuccess; ?> </span>
    </div>
    <div class="col-sm">
      
    </div>
</div>
</div>
  </form>


    </div>

<script>
    function myFunction() {

        var copyText = document.getElementById("myKey");
        copyText.select();
        document.execCommand("copy");
        alert("Key copied ! Ctr+V to use it");
    }
</script>

