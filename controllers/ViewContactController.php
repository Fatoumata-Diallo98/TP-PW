<?php
// controllers/ViewContactController.php

use DAO\ContactDAO;

class ViewContactController
{
    public function index(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $pdo = getPDO();
        $dao = new ContactDAO($pdo);

        $contact = $dao->findById($id);

        if ($contact === null) {
            http_response_code(404);
            $error = "Contact introuvable.";
        }

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/view_contact.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
