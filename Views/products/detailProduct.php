<?php
// var_dump($product);
?>

<?php if (isset($product)) : ?>
    <div class="card">
        <div class="card-header bg-primary mb-3 text-center">
            <h5 class="card-title"><?= $product['name'] ?></h5>
        </div>
        <img src="../public/images/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="300px" class="grow align-self-center img-thumbnail">

        <div class="card-body">
            <p>Description :</p>
            <p class="card-title"><?= $product['description'] ?></p>
        </div>
        <div class="card-footer bg-primary text-center">
            <p><span class="price"><?= $product['price'] ?> €</span></p>
            <a href="panier?opp=ajout&id=<?= $product['id'] ?>" class="btn btn-secondary">Ajouter au panier</a>
        </div>
    </div>

<?php endif ?>