<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
         * @Assert\Length(
         *      min = 2,
         *      max = 26,
         *      minMessage = "Your first name must be at least {{ limit }} characters long",
         *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
         * )
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 2,
     *      max = 26,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     *
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=62)
     *
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\Length(
     *      min=8,
     *      max = 8,
     *
     *      maxMessage = "Your number cannot be longer than {{ limit }} characters"
     * )
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=150)
     *
     * @Assert\NotBlank
     *
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\Regex(pattern="/^(?=.*[a-z])(?=.*\d).{6,}$/i", message="New password is required to be minimum 6 chars in length and to include at least one letter and one number."
     * )
     */
    private $password;

    /**
     * @ORM\Column(name="role", type="string", length=32,columnDefinition="enum('CLIENT', 'ADMIN','RESPONSABLE_ABONNEMENT','RESPONSABLE_RECLAMATION','RESPONSABLE_MDT','RESPONSABLE_VOYAGE','RESPONSABLE_RESERVATION')")
     */
    private $role;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date_user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $last_updated_user;

    protected $captchaCode;



    public function __construct()
    {

    }

    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getCreatedDateUser(): ?\DateTimeInterface
    {
        return $this->created_date_user;
    }

    public function setCreatedDateUser(\DateTimeInterface $created_date_user): self
    {
        $this->created_date_user = $created_date_user;

        return $this;
    }

    public function getLastUpdatedUser(): ?\DateTimeInterface
    {
        return $this->last_updated_user;
    }

    public function setLastUpdatedUser(\DateTimeInterface $last_updated_user): self
    {
        $this->last_updated_user = $last_updated_user;

        return $this;
    }


    public function getRoles()
    {
        return array('CLIENT', 'ADMIN','RESPONSABLE_ABONNEMENT','RESPONSABLE_RECLAMATION','RESPONSABLE_MDT','RESPONSABLE_VOYAGE','RESPONSABLE_RESERVATION');
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }







}
