<?php
require_once('../connect.php');
require_once('security.inc');
$error = "";

$sql = "SELECT * FROM categorie";
$res = mysqli_query($conn, $sql);

if(isset($_GET['id']) && $_GET['id'] <= 1000 && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
    $id = htmlspecialchars(addslashes($_GET['id']));
    $sql = "SELECT * FROM articles a
            INNER JOIN categorie c
            ON a.id_categorie = c.id
            WHERE a.id_a=$id";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
    }
}

if(isset($_POST['soumis'])){
    if(isset($_POST['titre']) && strlen($_POST['titre'])<=20 && strlen($_POST['titre'])>=1){
        $id_a = trim(htmlspecialchars(addslashes($_POST['id_a'])));
        $titre = trim(htmlspecialchars(addslashes($_POST['titre'])));
        $prix = trim(htmlspecialchars(addslashes($_POST['prix'])));
        $categorie = trim(htmlspecialchars(addslashes($_POST['categorie'])));
        $description = trim(htmlspecialchars(addslashes($_POST['description'])));
        $image = $_FILES['image']['name'];

        $destination ="../assets/images/";
        move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);

        if(empty($image)){
            $sql = "UPDATE articles SET titre = '$titre', prix = '$prix', id_categorie = '$categorie', description = '$description' 
            WHERE id_a = '$id_a'";
        }else{
            if(file_exists('../assets/images/'.$data['image'])){

                unlink('../assets/images/'.$data['image']);
            }
            $sql = "UPDATE articles SET titre = '$titre', prix = '$prix', id_categorie = '$categorie',image = '$image', description = '$description' 
            WHERE id_a = '$id_a'";
        }

        $resultat = mysqli_query($conn, $sql);

        if($resultat){
            header('location:liste.php');
        }
        }else{
            $error = '<div class="alert alert-danger">Erreur d\'insertion</div>';
        }
        
    }

 require_once('../partials/header.inc'); 
?>
<div class="container">
<h1 class="text-center">Admin</h1>
<div class="offset-2 col-8">
<h2>Formulaire d'édition</h2>
    <?= $error; ?>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_a" value="<?=$data['id_a'];?>">

        <div class="row">
            <div class="col-8">
                <label for="titre">Titre*</label>
                <input type="text" class="form-control" required id="titre" name="titre" placeholder="Entrez votre titre svp" value="<?=$data['titre'];?>">
            </div>
            <div class="col-4">
                <label for="prix">Prix*</label>
                <input type="number" class="form-control" required id="prix" name="prix" placeholder="Entrez le prix svp" value="<?=$data['prix'];?>">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="../assets/images/<?=$data['image'];?>" width="50" alt="">
            </div>
            <div class="col">
                <label for="categorie">Categorie*</label>
                <select class="form-select" required id="categorie" name="categorie">
                    <option value="<?=$data['id_categorie'];?>" ><?= ucfirst($data['nom']);?></option>
                    <?php while($rows = mysqli_fetch_assoc($res)){ if($data['id_categorie'] !== $rows['id']){ ?>
                        <option value="<?= $rows['id']; ?>"><?= ucfirst($rows['nom']); ?></option>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col mb-2">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" rows="5" placeholder="Entrez la description svp" name="description"><?=$data['description'];?></textarea>
            </div>
    
        </div>
        <a href="liste.php" class="btn btn-info offset-1 col-5" name="soumis">Retour</a>
        <button type="submit" class="btn btn-success col-5" name="soumis">Soumettre</button>
    </form>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br>
<?php require_once('../partials/footer.inc');?>