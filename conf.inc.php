<?php
 
$list_of_extensions = ['.png', '.gif', '.jpg', '.jpeg'];

$list_of_faction = ['Alharbi', 'Sharki'];

$list_of_privileges = [1,2,3];
 
$list_of_errors = [
                    1 => "Le pseudo doit faire plus de 2 caractères",
                    2 => "Adresse email non valide",
                    3 => "Le mot de passe doit faire au moins 5 caractères, comporter une majuscule et un chiffre",
                    4 => "Les mots de passe ne sont pas identique",
                    5 => "Les adresses email ne correspondent pas",
                    6 => "La faction n'est pas connue",
                    7 => "L'email est déjà existant",
                    8 => "le pseudo est déjà pris par un autre joueur",
                    9 => "Ce nom de guilde est déjà utilisé",
                    10 => "Ce TAG est déjà utlisé",
                    11 => "Ce TAG est trop grand : 4 caractères Maximum",
                    12 => "Vous devez uploader un fichier de type png, gif, jpg, jpeg",
                    13 => "Le fichier est trop gros",
                    14 => "Le captcha est incorrect",
                    15 => "L'email ou le mot de passe est incorrect",
                    16 => "Votre compte est banni",
                    17 => "Votre compte a été supprimé",
                    18 => "Votre compte n'est pas activé",
                        ];

$list_of_themes = [
   0 => "Dark Theme",
   1 =>"Night Theme",
   2 => "Light Theme",
   3 =>"Jungle Theme"
];

define("BDDUSER","root");
define("BDDPWD","root");
define("BDDHOST","localhost");
define("BDDNAME","nihil");