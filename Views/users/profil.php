<?php
// var_dump($_SESSION);



?>

<h3 class="text-center m-3">Bonjour <?= $_SESSION['user']['firstName'] ?></h3>
<!-- Pas avent la suppression de produit -->
<?php
if (isset($_SESSION['messages'])) {
    $message = $_SESSION['messages'];
    unset($_SESSION['messages']);

    echo '<div class="alert alert-dismissible alert-info">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <h4 class="alert-heading">Félicitation!</h4>
    <p class="mb-0">' . $message . '</p>
</div>';
}

?>
<!-- Fin pas avant suppresion de produit -->

<div class="container m-5">
    <a href="productAjout" class="btn btn-secondary">Ajouter un produit</a>
</div>

<?php if ($_SESSION['user']['role'] == 1): ?>
<h3>Tous les produits du site</h3>
<?php else :?>
<h3>Tous vos produits</h3>
<?php endif ?>
<table class="table table-hover text-center border-top border-success">
  <thead>
    <tr>
    <!-- <?php foreach ($products[0] as $key => $value) : ?>
        <?php if($key != 'id' && $key != "actif" && $key != "idCat") : ?>
        <th scope="col"><?= $key ?></th>
        <?php endif ?>
    <?php endforeach ?> -->
    <!-- c'est automatique mais c'est pas propre les titre de colonne s'affiche comme dans phpMyAdmin -->
    <th>Titre</th>
    <th>Prix</th>
    <th>Image</th>
    <th>description</th>
    <th>Catégorie</th>
    <th>Détail</th>
    <th>Modifier</th>
    <th>Supprimer</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($products as $key => $product) : ?>
    <tr class="table">
      <td><?= $product['name'] ?></td>
      <td><?= $product['price'] ?> €</td>
      <td><img src="../public/images/products/<?= $product['image'] ?>" class="imgTab" alt="<?= $product['name'] ?>"></td>
      <td><?= $product['description'] ?></td>
      <td><?= $product['nameCat'] ?></td>
      <td><a href="productDetail?id=<?= $product['id'] ?>" class="btn btn-info"><i class="bi bi-binoculars"></i></a></td>
      <td><a href="productModif?id=<?= $product['id'] ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
      <td><a href="productSupp?id=<?= $product['id'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
    </tr>
  <?php endforeach ?>  
  </tbody>
</table>

<?php if ($_SESSION['user']['role'] == 1): ?>
    <h3 class="mt-5">Tous les utilisateurs du site</h3>
    <table class="table table-hover text-center border-top border-success">
        <thead>
            <tr>
                <th>Login</th>
                <th>Nom</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $key => $info) : ?>
                <tr class="table">
                    <td><?= $info['login'] ?></td>
                    <td><?= $info['firstName'] ?></td>
                    <td><a href="" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>