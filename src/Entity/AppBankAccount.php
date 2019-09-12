<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AppBankAccount
 *
 * @ORM\Table(name="app_bank_account", indexes={@ORM\Index(name="IDX_912C248B4A3353D8", columns={"app_user_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\AppBankAccountRepository")
 */
class AppBankAccount
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_name", type="string", length=70, nullable=true)
     */
    private $accountName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="agency", type="string", length=5, nullable=true)
     */
    private $agency;

    /**
     * @var string|null
     *
     * @ORM\Column(name="agency_digit", type="string", length=1, nullable=true)
     */
    private $agencyDigit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_number", type="string", length=13, nullable=true)
     */
    private $accountNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_digit", type="string", length=1, nullable=true)
     */
    private $accountDigit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_type", type="string", length=100, nullable=true)
     */
    private $accountType;

    /**
     * @var \AppUser
     *
     * @ORM\ManyToOne(targetEntity="AppUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="app_user_id", referencedColumnName="id")
     * })
     */
    private $appUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBank", inversedBy="appBankAccount")
     * @ORM\JoinTable(name="app_bank_account_app_bank",
     *   joinColumns={
     *     @ORM\JoinColumn(name="app_bank_account_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="app_bank_id", referencedColumnName="id")
     *   }
     * )
     */
    private $appBank;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appBank = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    public function setAccountName(?string $accountName): self
    {
        $this->accountName = $accountName;

        return $this;
    }

    public function getAgency(): ?string
    {
        return $this->agency;
    }

    public function setAgency(?string $agency): self
    {
        $this->agency = $agency;

        return $this;
    }

    public function getAgencyDigit(): ?string
    {
        return $this->agencyDigit;
    }

    public function setAgencyDigit(?string $agencyDigit): self
    {
        $this->agencyDigit = $agencyDigit;

        return $this;
    }

    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(?string $accountNumber): self
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    public function getAccountDigit(): ?string
    {
        return $this->accountDigit;
    }

    public function setAccountDigit(?string $accountDigit): self
    {
        $this->accountDigit = $accountDigit;

        return $this;
    }

    public function getAccountType(): ?string
    {
        return $this->accountType;
    }

    public function setAccountType(?string $accountType): self
    {
        $this->accountType = $accountType;

        return $this;
    }

    public function getAppUser(): ?AppUser
    {
        return $this->appUser;
    }

    public function setAppUser(?AppUser $appUser): self
    {
        $this->appUser = $appUser;

        return $this;
    }

    /**
     * @return Collection|AppBank[]
     */
    public function getAppBank(): Collection
    {
        return $this->appBank;
    }

    public function addAppBank(AppBank $appBank): self
    {
        if (!$this->appBank->contains($appBank)) {
            $this->appBank[] = $appBank;
        }

        return $this;
    }

    public function removeAppBank(AppBank $appBank): self
    {
        if ($this->appBank->contains($appBank)) {
            $this->appBank->removeElement($appBank);
        }

        return $this;
    }

}
