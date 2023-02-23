<?php

namespace App\Entity;

use App\Repository\PizzaBestellungRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PizzaBestellungRepository::class)]
class PizzaBestellung
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $telefon = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[Assert\Range(min:0, max: 4)]
    #[ORM\Column(length: 255)]
    private ?string $groesse = null;

    public static function getDieGroesse(){
        return["klein", "mittel", "groß", "extragroß"];
    }


    #[Assert\Range(min:0, max: 2)]
    #[ORM\Column(length: 255)]
    private ?string $zustellung = null;

    public static function getZustellungsOptions() {
        return[ "Zustellung", "Selbstabholung"];
    }






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): self
    {
        $this->telefon = $telefon;

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

    public function getGroesse(): ?string
    {
        return $this->groesse;
    }

    public function setGroesse(string $groesse): self
    {
        $this->groesse = $groesse;

        return $this;
    }

    public function getZustellung(): ?string
    {
        return $this->zustellung;
    }

    public function setZustellung(string $zustellung): self
    {
        $this->zustellung = $zustellung;

        return $this;
    }
}
