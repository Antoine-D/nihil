<?php
 
$list_of_extensions = ['.png', '.gif', '.jpg', '.jpeg'];

$list_of_faction = ['Alharbi', 'Sharki'];

$list_of_privileges = [1,2,3];
 
$list_of_errors = [
                    1 => "Le pseudo doit faire plus de 2 caractères",
                    2 => "Adresse email non valide",
                    3 => "Le mot de passe doit faire entre 8 et 12 caractères",
                    4 => "Les mots de passe ne sont pas identique",
                    5 => "Les adresses email ne correspondent pas",
                    6 => "La faction n'est pas connue",
                    7 => "L'email est déjà existant",
                    8 => "le pseudo est déjà pris par un autre joueur",
                    9 => "Ce nom de guilde est déjà utilisé",
                    10 => "Ce TAG est déjà utlisé",
                    11 => "Ce TAG est trop grand",
                    12 => "Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...",
                    13 => "Le fichier est trop gros"
                        ];

$list_of_themes = [
    "Dark Theme",
    "Random Theme 1",
    "Random Theme 2",
    "Random Theme 3",
    "Random Theme 4",
    "Random Theme 5",
    "Random Theme 6",
    "Random Theme 7"
];

define("BDDUSER","dbo622019072");
define("BDDPWD","1405BDL-esgi");
define("BDDHOST","db622019072.db.1and1.com");
define("BDDNAME","db622019072");