<?php
session_start();
require_once('connect.php');
$sql = "SELECT * FROM articles a
INNER JOIN categorie c
ON a.id_categorie = c.id";
$result = mysqli_query($conn, $sql);


include_once 'partials/headerfront.inc';?>

<div class="container">
    <div class="bg-light text-center">
        <h1>Nos jeux du moment</h1>
        <p>Vous ne trouverez pas moins cher ailleur!!</p>
    </div>
    <div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php while($rows = mysqli_fetch_assoc($result)){?>
        <div class="col">
            <div class="card text-white bg-dark">
                <img src="assets/images/<?=$rows['image'];?>" class="card-img-top" alt="..." height="350">
                <div class="card-body">
                    <h5 class="card-title"><?=$rows['titre'];?></h5>
                    <p class="card-text">Prix : <?=$rows['prix'];?>€</p>
                    <p class="card-text">Genre : <?=$rows['nom'];?></p>
                    <p class="card-text">En vente depuis :
                        <?php
                            $date=$rows['date_created'];
                            $dateArray =(explode("-",substr($date,0,10)));
                            echo $dateArray[2].'/'.$dateArray[1].'/'.$dateArray[0];
                        ?>
                    </p>
                    <div class="visible-scrollbar">Synopsys : <?=$rows['description'];?></div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
</div>
<?php include_once 'partials/footer.inc';?>