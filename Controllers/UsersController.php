<?php

namespace Controllers;

class UsersController extends Controller{

    // Création d'un nouvel utilisateur
    public function inscription(){
        // Création du formulaire d'inscription

            // Le traitement du formulaire doit ce faire en premier
            // Mais nous allons commencer par la création du formulaire $formInscription
            // Note pour Moi pas avant d'avoir fait le formulaire

            ////////////// Début traitement du form///////////////
            $errMsg = '';
            if (!empty($_POST['login']) &&
                !empty($_POST['password']) &&
                ($_POST['password'] == $_POST['passwordConfirm'])    
            ) {
                echo 'ok';
            }elseif(!empty($_POST)){
                $errMsg = 'Vous n\'avez pas rempli tous les champs ou vos mots de passe ne concordent pas';
            };
            ////////////// Fin traitement du form/////////////////


        $formInscription = '
            <form action="inscription" method="POST" class="form">
            <div class="row justify-content-around">
                <div class="p-2 col-md-4">
                    <label for="login">Email</label>
                    <input type="email" name="login" id="login" class="form-control">
                </div>
                <div class="p-2 col-md-4">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="p-2 col-md-4">
                    <label for="passwordConfirm">Confirmation du mot de passe</label>
                    <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control">
                </div>
            </div>
            <button class="btn btn-primary d-block w-100">S\'inscrire</button>
            </form>
        ';
        // Note pour Moi quand le formulaire est fait commencer par vérifier son affichage avec render et ensuite passer au traitemnt du form


        $this->render('users/inscription', [
            'title' => 'Inscription',
            // Ajouter le message au moment du traitement
            'errMsg' => $errMsg,
            'formInscription' => $formInscription
        ]);
    }
}
