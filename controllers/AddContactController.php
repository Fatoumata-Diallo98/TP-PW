<?php
// controllers/AddContactController.php

use DAO\ContactDAO;
use models\ContactModel;

class AddContactController
{
    public function index(): void
    {
        $errors = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom       = trim($_POST['nom'] ?? '');
            $prenom    = trim($_POST['prenom'] ?? '');
            $email     = trim($_POST['email'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');

            // Validation simple
            if ($nom === '')       $errors[] = "Le nom est obligatoire.";
            if ($prenom === '')    $errors[] = "Le prénom est obligatoire.";
            if ($telephone === '') $errors[] = "Le téléphone est obligatoire.";
            if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse email n'est pas valide.";
            }

            if (empty($errors)) {
                $pdo = getPDO();
                $dao = new ContactDAO($pdo);

                $contact = new ContactModel(
                    null,
                    $nom,
                    $prenom,
                    $email !== '' ? $email : null,
                    $telephone
                );

                if ($dao->create($contact)) {
                    // Redirection pour éviter le repost du formulaire
                    header('Location: index.php?page=home&success=1');
                    exit;
                } else {
                    $errors[] = "Erreur lors de l'enregistrement du contact.";
                }
            }
        }

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/add_contact.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
