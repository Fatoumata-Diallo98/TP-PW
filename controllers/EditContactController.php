<?php
// controllers/EditContactController.php

use DAO\ContactDAO;
use models\ContactModel;

class EditContactController
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
            include __DIR__ . '/../views/edit_contact.php';
            include __DIR__ . '/../views/layout/footer.php';
            return;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom       = trim($_POST['nom'] ?? '');
            $prenom    = trim($_POST['prenom'] ?? '');
            $email     = trim($_POST['email'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');

            if ($nom === '')       $errors[] = "Le nom est obligatoire.";
            if ($prenom === '')    $errors[] = "Le prénom est obligatoire.";
            if ($telephone === '') $errors[] = "Le téléphone est obligatoire.";
            if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse email n'est pas valide.";
            }

            if (empty($errors)) {
                $contact->setNom($nom);
                $contact->setPrenom($prenom);
                $contact->setEmail($email !== '' ? $email : null);
                $contact->setTelephone($telephone);

                if ($dao->update($contact)) {
                    header('Location: index.php?page=view&id=' . $contact->getId());
                    exit;
                } else {
                    $errors[] = "Erreur lors de la mise à jour du contact.";
                }
            }
        }

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/edit_contact.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
