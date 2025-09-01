<?php
require_once 'user.php';

class Etudiant extends User
{
    private $date_naissance;
// In Etudiant.php
public function __construct($nom, $prenom, $email, $password, $telephone = null, $date_naissance = null)
{
    parent::__construct($nom, $prenom, $email, $password, $telephone, 'etudiant');
    $this->date_naissance = $date_naissance;
}
    public function getId() { 
        return $this->id; 
    }
    
    public function getDateNaissance() { return $this->date_naissance; }
    public function setDateNaissance($date) { $this->date_naissance = $date; }
    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }
}
