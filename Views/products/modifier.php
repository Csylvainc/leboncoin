<?php if (!empty($message)) : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Attention!</h4>
        <p class="mb-0"><?= $message ?></p>
    </div>
<?php endif ?>

<form action="" method="POST" class="form" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name">Nom du produit</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= $product['name'] ?>">
    </div>
    <select name="categorie" id="categorie" class="form-select">
        <option value="" disabled>Choisissez une catégorie</option>
        <?php foreach ($categories as $key => $categorie) : ?>
            <option value="<?= $categorie['idCat'] ?>" <?= $categorie['idCat']==$product['idCategorie'] ? "selected" : null ?>><?= $categorie['nameCat'] ?></option>
        <?php endforeach ?>
    </select>
    <div>
        <label for="price">Prix</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= $product['price'] ?>">
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" class="form-control" value="<?= $product['description'] ?>">
    </div>
    <div class="mt-3">
        <label for="photo" class="form-label">Photo</label>
        <p>Si vide nous conservons l'encienne <img src="../public/images/products/<?= $product['image'] ?>" alt="" class="imgTab"></p>
        <input type="file" name="photo" id="photo" class="form-control">
        <small id="photo" class="form-text text-muted">(max 3Mo, format accepté: jpg, jpeg, png)</small>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Modifier</button>
</form>