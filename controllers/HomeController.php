<?php
// controllers/HomeController.php

use DAO\ContactDAO;

class HomeController
{
    public function index(): void
    {
        $pdo = getPDO();
        $dao = new ContactDAO($pdo);
        $contacts = $dao->findAll();

        $message = null;
        if (isset($_GET['success']) && $_GET['success'] === '1') {
            $message = "Opération effectuée avec succès.";
        }

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/home.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
