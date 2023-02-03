<?php
// var_dump($products);

// var_dump($categories);
// var_dump($_GET);
?>
<?php if (!isset($_GET['idCategorie'])) : ?>
    <h2 class="m-4 text-center">Toutes les catégories</h2>
<?php else : ?>
    <h2 class="m-4 text-center">Produits de la catégorie : <?= $products[0]['nameCat'] ?></h2> <!-- Attention si pas de produit alors erreur php pas joli -->
<?php endif ?>
<div class="row">
    <div class="col-12 col-md-2">
        <form method="GET">
            <div class="mb-3">
                <label for="idCategorie" class="form-label">Filtrer par catégorie</label>
                <select name="idCategorie" id="categorie" class="form-select">
                    <option value="null">Toutes catégories</option>
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie['idCat'] ?>"><?= $categorie['nameCat'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Trier par prix</label>
                <select name="order" id="order" class="form-select">
                    <option value="price DESC">Prix descendant</option>
                    <option value="price ASC">Prix ascendant</option>
                </select>
            </div>
            <button class="btn btn-secondary">Valider</button>
        </form>
    </div>
    <div class="col-12 col-md-8 container border border-secondary p-5">
        <div class="row justify-content-between">
        
        <?php foreach ($products as $key => $product) : ?>
        <div class="card text-white bg-primary mb-3 col-12 col-md-5 shadow-lg">
          <div class="card-header"><p><u>Catégorie : <?= $product['nameCat'] ?></u></p></div>
          <div class="card-body">
            <h4 class="card-title"><?= $product['name'] ?>  <?= $product['price'] ?> €</h4>
            <img src="../public/images/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="rounded mx-auto d-block img-fluid">
            <p class="card-text">Description : <br><?= $product['description'] ?></p>
          </div>
          <div class="card-footer text-center">
            <a href="productDetail?id=<?= $product['id'] ?>" class="btn btn-secondary shadow">détail <?= $product['name'] ?></a>
          </div>
        </div>
        <?php endforeach ?>
        </div>
    
    </div>

</div>
