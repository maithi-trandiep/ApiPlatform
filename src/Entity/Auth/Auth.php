<?php

namespace App\Entity\Auth;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\RolesEnum;
use App\Enum\UserAccountTypeEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait Auth
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[Groups(['product:read', 'comment:read', 'user:read', 'user:write'])]
    #[Assert\Email()]
    #[ORM\Column(length: 180, unique: true)]
    private string $email = '';

    #[Groups(['user:read:full'])]
    #[ORM\Column]
    private array $roles = [];

    /** @var string The hashed password */
    #[ORM\Column]
    private string $password = '';

    #[Groups(['user:write', 'user:write:update'])]
    private ?string $plainPassword = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;

        [$username, ] = explode('@', $email);
        $this->setName($username);
    }

    /** @see UserInterface */
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /** @see UserInterface */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER'; // guarantee every user at least has ROLE_USER

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    #[Groups(['user:write'])]
    #[ApiProperty(example: UserAccountTypeEnum::NORMAL->value)]
    public function setAccountType(string $type): void
    {
        $enum = UserAccountTypeEnum::from($type);

        if ($enum === UserAccountTypeEnum::ADMIN) {
            $this->setRoles([RolesEnum::ADMIN->value]);

            return;
        }

        $this->setRoles([RolesEnum::USER->value]);
    }

    /** @see PasswordAuthenticatedUserInterface */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /** @see UserInterface */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }
}
