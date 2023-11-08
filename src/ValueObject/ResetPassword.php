<?php

declare(strict_types=1);

namespace App\ValueObject;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Action\Auth\ResetPassword as ResetPasswordAction;
use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Post(
            name: 'ResetPassword',
            uriTemplate: '/users/reset-password',
            controller: ResetPasswordAction::class,
            output: User::class,
            normalizationContext: ['groups' => ['read-user']],
        ),
    ],
)]
class ResetPassword
{
    #[Assert\Email()]
    private string $email = '';

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
