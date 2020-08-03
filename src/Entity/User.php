<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="username")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $profile;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /*
     * @ORM\Column(name="roles", type="array")
     * private $roles = array();
    */

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     * @var string The hashed password
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=250)
     */
    private $plainPassword;

/************************* GETTERS ****************************** */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfile(): string
    {
        return (string) $this->profile;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    function getPlainPassword() {
        return $this->plainPassword;
    }

    public function getRoles(): ?array
    {
        $generate_role = 'ROLE_' . strtoupper($this->getProfile());
        return $this->role = array($generate_role);
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
        return null;
    }

/************************* SETTERS ****************************** */    
    public function setProfile(string $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

}