<?php

namespace Controllers;

use Models\ProductsModel;
use Models\UsersModel;

class UsersController extends Controller
{

    // Création d'un nouvel utilisateur
    public function inscription()
    {
        // Création du formulaire d'inscription

        // Le traitement du formulaire doit ce faire en premier
        // Mais nous allons commencer par la création du formulaire $formInscription
        // Note pour Moi pas avant d'avoir fait le formulaire

        ////////////// Début traitement du form///////////////
        $errMsg = '';
        if (
            !empty($_POST['login']) &&
            !empty($_POST['password']) &&
            !empty($_POST['firstName']) &&
            ($_POST['password'] == $_POST['passwordConfirm'])
        ) {
            // echo 'ok';
            // Si tous les champs sont rempli on vérifi que l'email soit au bon format
            if (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
                $errMsg = "Merci de saisir un email valide";
            } else {
                // Si tout est OK
                $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                // On vérifi que l'email ne soit pas deja en BDD
                // On met le login dans un tableau
                $login = [$_POST['login']];
                // On instancie un objet user pour faire une requete findByLogin
                // $user = new UsersModel;
                $testLogin = UsersModel::findByLogin($login);
                // Si $testLogin n'est pas vide le login existe deja
                if ($testLogin) {
                    $errMsg = "Ce login existe deja";
                } else {
                    // On sécurise le firstName
                    $firstName = strip_tags($_POST['firstName']);
                    // On enregistre en BDD
                    $newUser = [$_POST['login'], $pass, $firstName];
                    UsersModel::create($newUser);
                    // Quand l'utilisateur c'est inscrit il faut le rediriger vers la page de connexion et afficher un message
                    // de confirmation d'inscription
                    // On ajoute l'ouverture de session dans index
                    // On commence par créer la vue connexion
                    // Le message doit être enregistré dans la session
                    $_SESSION['message'] = "Votre compte est crée, vous pouvez vous connecter";
                    header('Location: connexion');
                }
            }
        } elseif (!empty($_POST)) {
            var_dump($_POST);
            $errMsg = 'Vous n\'avez pas rempli tous les champs ou vos mots de passe ne concordent pas';
        };
        ////////////// Fin traitement du form/////////////////


        $formInscription = '
            <form action="inscription" method="POST" class="form">
            <div class="row justify-content-around">
                <div class="p-2 col-md-4">
                    <label for="login">Email</label>
                    <input type="email" name="login" id="login" class="form-control">
                    <label for="firstName">Prénom</label>
                    <input type="text" name="firstName" id="firstName" class="form-control">

                </div>
                <div class="p-2 col-md-4">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control">
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

    public function connexion(){
        $errMsg = "";

        // Traitement du formulaire apres la création du formulaire
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            // On sécurise la saisie de l'utilisateur
            $login = strip_tags($_POST['login']);
            // On vérifie que l'utilisateur est présent en BDD
            $user = UsersModel::findByLogin([$login]);
            // Si $user est vide
            // var_dump($user);
            if (!$user) {
                $errMsg = "Login ou mot de passe incorrect";
            }else{
                $pass = $_POST['password'];
                if (password_verify($pass, $user['password'])) {
                    // Enregistrement des infos de l'utilisateur en session
                    $_SESSION['messages'] = "Content de vous revoir";
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'login' => $user['login'],
                        'firstName' => $user['firstName'],
                        'role' => $user['role']
                    ];
                    // Redirection vers la pge d'accueil et ajout du test sur $_SESSION sur la page d'accueil
                    header('Location: /' . SITEBASE);
                }else{
                    $errMsg = "Login ou mot de passe incorrect";
                }
            }
        }elseif(!empty($_POST)){
            $errMsg = "Login ou mot de passe incorrect";
        }

        $formConnexion = '
            <form action="connexion" method="POST" class="form mt-5">
            <div class="row justify-content-around">
                <div class="p-2 col-md-4">
                    <label for="login">Email</label>
                    <input type="email" name="login" id="login" class="form-control">
                </div>
                <div class="p-2 col-md-4">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <button class="btn btn-primary d-block w-75 mx-auto mt-3">Se connecter</button>
            </form>
        ';
        
        $this->render('users/connexion', [
            'title' => 'Connexion',
            // Ajouter le message au moment du traitement
            'errMsg' => $errMsg,
            'formConnexion' => $formConnexion
        ]);
    }


    // Méthode profil
    public function profil(){
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] == 1) {
                // L'admin est connecté il doit voir tous les produits
                $products = ProductsModel::findAll();
                // Il voit aussi tous les utilisateurs
                $user = UsersModel::findAll();
            }else{
                // Uniquement les produits de l'utilisateur
                $user = [$_SESSION['user']['id']];
                $products = ProductsModel::findByUser($user);
            }
        }else{
            header('Location: /connexion');
        }

        $this->render('users/profil', [
            'title' => 'Profil',
            'products' => $products,
            'user' => $user
        ]);
    }
}
