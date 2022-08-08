<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $legal_name = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $cnpj = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $net_revenue = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $ebtida = null;

    #[ORM\Column(nullable: true)]
    private ?int $employees = null;

    #[ORM\Column(nullable: true)]
    private ?int $info_year = null;

    #[ORM\Column(length: 255)]
    private ?string $corporation_structure = null;

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

    public function getLegalName(): ?string
    {
        return $this->legal_name;
    }

    public function setLegalName(?string $legal_name): self
    {
        $this->legal_name = $legal_name;

        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(?string $cnpj): self
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getNetRevenue(): ?string
    {
        return $this->net_revenue;
    }

    public function setNetRevenue(?string $net_revenue): self
    {
        $this->net_revenue = $net_revenue;

        return $this;
    }

    public function getEbtida(): ?string
    {
        return $this->ebtida;
    }

    public function setEbtida(?string $ebtida): self
    {
        $this->ebtida = $ebtida;

        return $this;
    }

    public function getEmployees(): ?int
    {
        return $this->employees;
    }

    public function setEmployees(?int $employees): self
    {
        $this->employees = $employees;

        return $this;
    }

    public function getInfoYear(): ?int
    {
        return $this->info_year;
    }

    public function setInfoYear(?int $info_year): self
    {
        $this->info_year = $info_year;

        return $this;
    }

    public function getCorporationStructure(): ?string
    {
        return $this->corporation_structure;
    }

    public function setCorporationStructure(string $corporation_structure): self
    {
        $this->corporation_structure = $corporation_structure;

        return $this;
    }
}
