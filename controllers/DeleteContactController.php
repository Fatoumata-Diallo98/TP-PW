<?php
// controllers/DeleteContactController.php

use DAO\ContactDAO;

class DeleteContactController
{
    public function index(): void
    {
        $pdo = getPDO();
        $dao = new ContactDAO($pdo);

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $contact = $dao->findById($id);

        if ($contact === null) {
            http_response_code(404);
            $error = "Contact introuvable.";
            include __DIR__ . '/../views/layout/header.php';
            include __DIR__ . '/../views/delete_contact.php';
            include __DIR__ . '/../views/layout/footer.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['confirm']) && $_POST['confirm'] === 'oui') {
                $dao->delete($id);
                header('Location: index.php?page=home&success=1');
                exit;
            } else {
                header('Location: index.php?page=view&id=' . $id);
                exit;
            }
        }

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/delete_contact.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
