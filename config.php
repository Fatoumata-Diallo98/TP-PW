<?php
// config.php

// Config BDD
define('DB_HOST', 'localhost');
define('DB_NAME', 'contacts');
define('DB_USER', 'root');
define('DB_PASS', ''); // à adapter

/**
 * Retourne une instance PDO (singleton).
 */
function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    return $pdo;
}

/**
 * Autoloader pour les classes du dossier /classes
 * avec les namespaces models\ et DAO\
 */
function myAutoloader($className)
{
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $classFile = __DIR__ . '/classes/' . $className . '.php';

    if (file_exists($classFile)) {
        require_once $classFile;
    }
}

// Enregistrement de l'autoloader
spl_autoload_register('myAutoloader');
