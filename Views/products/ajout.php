<form action="productAjout" method="POST" class="form" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name">Nom du produit</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <select name="categorie" id="categorie" class="form-select">
        <option value="" disabled selected>Choisissez une catégorie</option>
        <?php foreach ($categories as $key => $categorie) : ?>
            <option value="<?= $categorie['idCat'] ?>"><?= $categorie['nameCat'] ?></option>
        <?php endforeach ?>
    </select>
    <div>
        <label for="price">Prix</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control">
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" class="form-control">
    </div>
    <div>
        <label for="photo" class="form-label">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control">
        <small id="photo" class="form-text text-muted">(max 3Mo, format accepté: jpg, jpeg, png)</small>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
</form>