
<!-- Message de session -->
<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);

    echo '<div class="alert alert-dismissible alert-info">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <h4 class="alert-heading">Félicitation!</h4>
    <p class="mb-0">' . $message . '</p>
</div>';
}

?>
<!-- Message d'erreur de connexion -->
<?php if (!empty($errMsg)) : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Attention!</h4>
        <p class="mb-0"><?= $errMsg ?></p>
    </div>
<?php endif ?>

<div class="container-fluid">
    <?= $formConnexion ?>
</div>

