<?php
//  var_dump($products);

?>


<h2 class="mt-4 lead">Les derniers produits mit en ligne</h2>

<div class="container border border-secondary p-5">
    <div class="row justify-content-around">
    
    <?php foreach ($products as $key => $product) : ?>
    <div class="card text-white bg-primary mb-3 col-12 col-md-4 shadow-lg">
      <div class="card-header"><p><u>Catégorie : <?= $product['nameCat'] ?></u></p></div>
      <div class="card-body">
        <h4 class="card-title"><?= $product['name'] ?>  <?= $product['price'] ?> €</h4>
        <img src="../public/images/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="rounded mx-auto d-block img-fluid">
        <p class="card-text">Description : <br><?= $product['description'] ?></p>
      </div>
      <div class="card-footer text-center">
        <a href="productDetail?id=<?= $product['id'] ?>" class="btn btn-secondary shadow">Voir le détail</a>
      </div>
    </div>
    <?php endforeach ?>
    </div>

</div>
