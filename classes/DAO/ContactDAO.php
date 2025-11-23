<?php
// classes/DAO/ContactDAO.php
namespace DAO;

use models\ContactModel;
use PDO;

class ContactDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /** Insère un nouveau contact */
    public function create(ContactModel $contact): bool
    {
        $sql = "INSERT INTO contacts (nom, prenom, email, telephone)
                VALUES (:nom, :prenom, :email, :telephone)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nom'       => $contact->getNom(),
            ':prenom'    => $contact->getPrenom(),
            ':email'     => $contact->getEmail(),
            ':telephone' => $contact->getTelephone(),
        ]);
    }

    /** Retourne un contact par son id */
    public function findById(int $id): ?ContactModel
    {
        $sql = "SELECT * FROM contacts WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch();

        if ($data === false) {
            return null;
        }

        return new ContactModel(
            $data['id'],
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['telephone']
        );
    }

    /** Retourne tous les contacts */
    public function findAll(): array
    {
        $sql = "SELECT * FROM contacts ORDER BY nom, prenom";
        $stmt = $this->pdo->query($sql);
        $contacts = [];

        while ($row = $stmt->fetch()) {
            $contacts[] = new ContactModel(
                $row['id'],
                $row['nom'],
                $row['prenom'],
                $row['email'],
                $row['telephone']
            );
        }

        return $contacts;
    }

    /** Met à jour un contact */
    public function update(ContactModel $contact): bool
    {
        $sql = "UPDATE contacts
                SET nom = :nom,
                    prenom = :prenom,
                    email = :email,
                    telephone = :telephone
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nom'       => $contact->getNom(),
            ':prenom'    => $contact->getPrenom(),
            ':email'     => $contact->getEmail(),
            ':telephone' => $contact->getTelephone(),
            ':id'        => $contact->getId(),
        ]);
    }

    /** Supprime un contact */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM contacts WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
