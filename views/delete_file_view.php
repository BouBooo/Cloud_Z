 
<div class="container">
        <h1><strong>Supprimer un item</strong></h1>
            <br>
            <form class="form" action="" role="form" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <p class="alert alert-warning">Etes vous sûr de vouloir supprimer ce fichier? </p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Oui</button>
                        <a class="btn btn-default" href="
                                                        <?php
                                                            if($_SESSION['admin'] == 1)
                                                            {
                                                                echo "index.php?page=admin";
                                                            }
                                                            else
                                                            {
                                                                echo "index.php?page=files";
                                                            }
                                                            ?>
                                                            ">Non</a>
                    </div>
            </form>
</div>


