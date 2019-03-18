<div class="container">
        <h1><strong>Supprimer un item</strong></h1>
            <br>
            <form class="form" action="" role="form" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <p class="alert alert-warning">Are you sure about this message suppression ? </p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Yes</button>
                        <a class="btn btn-default" href="index.php?page=messagerie">Non</a>
                    </div>
            </form>
</div>
