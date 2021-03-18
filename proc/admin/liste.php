<?php

require_once('../connect.php');
require_once('security.inc');
if(isset($_POST['submit']) && !empty($_POST['search'])){
    $mCle = trim(addslashes(htmlentities($_POST['search'])));
    $sql = " SELECT * FROM articles a
    INNER JOIN categorie c
    ON a.id_categorie = c.id
    WHERE titre LIKE '$mCle%' OR nom LIKE '$mCle%'";
}else{
    $sql = "SELECT * FROM articles a
        INNER JOIN categorie c
        ON a.id_categorie = c.id";
}
$result = mysqli_query($conn, $sql);

include_once '../partials/header.inc';?>
<div class="container">
    <h1>Liste des jeux disponible</h1>
    <?php if(isset($_SESSION['auth']) && $_SESSION['auth']['role']==1){ ?>
    <p class="text-right"><a href="ajouter.php" class="btn btn-info"><i class="fas fa-plus"></i> Ajouter</a></p>
    <?php } ?>
    <form action="<?=$_SERVER['PHP_SELF']; ?>" method="post" >
        <div class="input-group justify-content-end">
            <input type="search" class="form-control offset-9 col-3 text-center" name="search" id="search" placeholder="Recherche">
            <button type="submit" name="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Prix</th>
                <th>Image</th>
                <th>categorie</th>
                <th>Date d'ajoute</th>
                <?php if(isset($_SESSION['auth']) && $_SESSION['auth']['role']==1){ ?>
                <th colspan="2" class="text-center">Actions</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            while($rows = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?= $rows['id_a']; ?></td>
                <td><?= $rows['titre']; ?></td>
                <td><?= $rows['prix']; ?></td>
                <td><img src="../assets/images/<?= $rows['image']; ?>" width="50" alt="..."></td>
                <td><?= $rows['nom']; ?></td>
                <td><?= $rows['date_created']; ?></td>
                <?php if(isset($_SESSION['auth']) && $_SESSION['auth']['role']==1){ ?>
                <td>
                    <a href="editer.php?id=<?= $rows['id_a']; ?>" class="btn btn-success">
                    <i class="fas fa-edit"></i> Editer</a>
                </td>
                <td>
                    <a href="supprimer.php?id=<?= $rows['id_a']; ?>" class="btn btn-danger" onclick="return confirm('Êtes vous sûr de vouloir supprimer')">
                    <i class="fas fa-trash"></i> Supprimer</a>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
<?php include_once '../partials/footer.inc';?>