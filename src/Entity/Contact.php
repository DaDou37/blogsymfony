<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact 
{
    #[Assert\NotBlank(message: 'le prenom est obligatoire')]
    #[Assert\Length(
        min: 2, 
        max: 50,
        minMessage: 'Le prenom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le prenom ne doit pas dépasser {{ limit }} caractères'
    )]
    private string $firstName;

    #[Assert\NotBlank(message: 'le nom est obligatoire')]
    #[Assert\Length(
        min: 2, 
        max: 50,
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le nom ne doit pas dépasser {{ limit }} caractères'
    )]
    private string $lastName;

    #[Assert\NotBlank(message: 'le mail est obligatoire')]
    #[Assert\Email(message: 'l\'adresse mail n\'est pas valide')]
    
    private string $email;

    #[Assert\NotBlank(message: 'l\'objet est obligatoire')]
    #[Assert\Length(
        min: 2, 
        max: 50,
        minMessage: 'L\'objet doit contenir au moins {{ limit }} caractères',
        maxMessage: 'L\'objet ne doit pas dépasser {{ limit }} caractères'
    )]
    private string $subject;

    #[Assert\NotBlank(message: 'le message est obligatoire')]
    private string $message;

    #[Assert\NotBlank(message: 'le téléphone est obligatoire')]
    #[Assert\Regex(
        pattern: '/^\+?[0-9\s\-()]{7,20}$/',
        message: 'le numéro de téléphone est invalide'
    )]
    private string $phone;

    // Getters and Setters

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = htmlspecialchars(strip_tags($firstName)); // evite l'injection de JS dans le code 
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = filter_var($email, \FILTER_SANITIZE_EMAIL); // verifie une 2eme fois si lemail est bien formaté
        return $this;
        /**
         * si l'utilisateur rentre dans le champs input Robert <script>@gmail.com
         * la sortie va être Robert@gmail.com 
        */
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }
}
