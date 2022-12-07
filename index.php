<?php

// Autoload classes
require_once('./Autoloader.php');
Autoloader::register();

// Set l'application afin de recevoir et renvoyer du contenu au format JSON
header ('Content-type: application/json; charset=UTF-8');

try {

    // On nettoie l'url, afin de se prémunir d'éventuelles attaques.
    // On le divise et le stock dans la variable '$url'
    $url = preg_split('@/@', $_GET['req'], -1, PREG_SPLIT_NO_EMPTY);

    // Selon le choix de l'utilisateur, nous instancions soit une/des Catégorie(s), soit un/des Magasin(s).

    // Nous stockons cette instance au sein de la variable $Controller.
    if (strtolower($url[0]) === 'magasins') {
        $controller = new Magasins;
    } elseif (strtolower($url[0]) === 'categories') { 
        $controller = new Categories;
    } elseif (($url[0]) !== 'magasins' || $url[0] !== 'categories') { 
        http_response_code(404);
        die (json_encode(["Message" => "Aucune ressource trouvée."], true));

    }
    
} catch (Throwable $e) {
    // On restreint l'usage de notre API à la demande de MAGASINS ou de CATEGORIES DE MAGASINS
    http_response_code(404);
    echo json_encode(['Message' => 'Les ressources demandées n\'ont pas été trouvé.', 'Erreur' => 404], JSON_UNESCAPED_UNICODE);
}

try {

    // Combien y'a t-il de parametres (urn) dans l'url ? 
    // 2 ? nous stockons dans la variable $secondParam le deuxieme parametre sinon nous rendons la var NULL.
    reset($url);
    if (array_key_exists(1, $url)) {
        if ($url[1] !== null || !empty($url[1])) {
            $secondParam = $url[1];
        }
    } else {
        $secondParam = null;
    }
    // 3 ? nous stockons dans la variable $thirdParam le troisieme parametre sinon nous rendons la var NULL.
    reset($url);
    if (array_key_exists(2, $url)) { 
        if ($url[2] !== null || !empty($url[2])) {
            // On envoie au controlleur la methode à éxécuter.
            $thirdParam = $url[2];

            $callMethod = "get" . ucfirst(strtolower($thirdParam));
        } else {
            $callMethod = null;
        } 
    } else {
        $callMethod = null;
    }

    $controller->manageRequest($_SERVER["REQUEST_METHOD"], $secondParam, $callMethod);

} catch (Throwable $e) {
        // On restreint l'usage de notre API à la demande de MAGASINS ou de CATEGORIES DE MAGASINS
        http_response_code(404);
        echo json_encode(['Message' => $e->getMessage(), 'Erreur' => 404], JSON_UNESCAPED_UNICODE);
}



        



