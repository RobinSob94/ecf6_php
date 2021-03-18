<?php
require_once('../connect.php');
require_once('security.inc');
$error="";
$sql = "SELECT * FROM categorie";
$result = mysqli_query($conn, $sql);

if(isset($_POST['soumis'])){
    if(isset($_POST['titre']) && strlen($_POST['titre'])<=20 && strlen($_POST['titre'])>=1){
        $titre = trim(htmlspecialchars(addslashes($_POST['titre'])));
        $prix = trim(htmlspecialchars(addslashes($_POST['prix'])));
        $categorie = trim(htmlspecialchars(addslashes($_POST['categorie'])));
        $description = trim(htmlspecialchars(addslashes($_POST['description'])));
        $image = $_FILES['image']['name'];

        $destination ="../assets/images/";
        move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);

        $sql2 ="INSERT INTO articles(titre,prix,image, description,id_categorie)
                VALUES('$titre','$prix','$image','$description','$categorie')";
        $result2 = mysqli_query($conn,$sql2);

        if(mysqli_insert_id($conn)>0){
            header('location:liste.php');
        }else{
            $error = '<div class="alert alter-danger">Erreur d\'ajout</div>';
        }
    }
}

require_once('../partials/header.inc'); 

?>
<div class="container">
<h1 class="text-center">Admin</h1>
<div class="offset-1 col-10">
<h2>Formulaire d'ajout</h2>
<?= $error;?>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-8">
                <label for="titre">Titre*</label>
                <input type="text" class="form-control" required id="titre" name="titre"
                    placeholder="Entrez votre titre svp">
            </div>
            <div class="col-4">
                <label for="prix">Prix*</label>
                <input type="number" class="form-control" required id="prix" name="prix" placeholder="Entrez le prix svp"
                    min="18">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="col">
                <label for="categorie">Categorie*</label>
                <select class="form-select" required id="categorie" name="categorie">
                    <option>Choisir</option>
                    <?php
                while($rows = mysqli_fetch_assoc($result)){
            ?>
                    <option value="<?= $rows['id']; ?>">
                        <?= $rows['nom']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col mb-2">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" rows="5" placeholder="Entrez la description svp"
                    name="description"></textarea>
            </div>
    
        </div>
        <a href="liste.php" class="btn btn-info offset-1 col-5" name="soumis">Retour</a>
        <button type="submit" class="btn btn-success col-5" name="soumis">Soumettre</button>
    </form>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>

<?php require_once('../partials/footer.inc');?>