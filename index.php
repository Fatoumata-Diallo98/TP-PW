<?php
// index.php
require_once __DIR__ . '/config.php';

// Page demandée, par défaut : home
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Routes : clé = valeur de ?page=..., valeur = nom du contrôleur
$controllers = [
    'home'   => 'HomeController',
    'add'    => 'AddContactController',
    'view'   => 'ViewContactController',
    'edit'   => 'EditContactController',
    'delete' => 'DeleteContactController',
];

// Chemin du contrôleur
if (array_key_exists($page, $controllers)) {
    $controllerName = $controllers[$page];
    $controllerFile = __DIR__ . '/controllers/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controller = new $controllerName();
        // méthode principale : index()
        $controller->index();
    } else {
        echo "Contrôleur introuvable.";
    }
} else {
    // 404 simple
    http_response_code(404);
    echo "Page non trouvée.";
}
