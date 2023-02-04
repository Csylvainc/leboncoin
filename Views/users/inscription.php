<!-- Pas avant le traitement du form -->
<?php if (!empty($errMsg)) : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Attention!</h4>
        <p class="mb-0"><?= $errMsg ?></p>
    </div>
<?php endif ?>
<!-- FIN Pas avant le traitement du form -->


<div class="container-fluid">
    <?= $formInscription ?>
</div>