<div class="container">
  <div class="row">
        <h1><strong>User suppression</strong></h1>
        <br>
                  <br>
                <form class="form" action="" role="form" method="post">
                   <input type="hidden" name="id" value="<?php echo $id; ?>">


                    <!-- Delete verification -->
                   <p class="alert alert-warning">Are you sure you want to delete this user ? </p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Yes</button>
                        <a class="btn btn-default" href="index.php">No</a>
                   </div>
                </form>

    </div>
</div>