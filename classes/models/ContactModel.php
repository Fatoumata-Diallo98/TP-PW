<?php
// classes/models/ContactModel.php
namespace models;

class ContactModel
{
    private ?int $id;
    private string $nom;
    private string $prenom;
    private ?string $email;
    private string $telephone;

    public function __construct(
        ?int $id = null,
        string $nom = '',
        string $prenom = '',
        ?string $email = null,
        string $telephone = ''
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    // Getters / setters
    public function getId(): ?int      { return $this->id; }
    public function getNom(): string   { return $this->nom; }
    public function getPrenom(): string{ return $this->prenom; }
    public function getEmail(): ?string{ return $this->email; }
    public function getTelephone(): string { return $this->telephone; }

    public function setId(?int $id): void               { $this->id = $id; }
    public function setNom(string $nom): void           { $this->nom = $nom; }
    public function setPrenom(string $prenom): void     { $this->prenom = $prenom; }
    public function setEmail(?string $email): void      { $this->email = $email; }
    public function setTelephone(string $tel): void     { $this->telephone = $tel; }
}
