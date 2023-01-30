<?php
namespace Controllers;

class Controller{
    // Création du render
    public function render($views, $data = []){
        // On utilise "extract()" pour créer autant de variables que de clé dans le tableau $data
        extract($data); // $data = ['title' => 'nom de la vue, 'form' => '<form></form>'] par exemple

        // On commence à mettre en mémoire les données
        ob_start();

        // on appelle la bonne vue
        require_once ROOT . "/Views/" . $views . ".php";

        // On crée une variable qui va contenir cette vue pour pouvoir l'envoyer au layout
        $content = ob_get_clean();

        // On appelle le layout principale
        require_once ROOT . "/Views/layout.php";

    }
}