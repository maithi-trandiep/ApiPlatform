<?php

declare(strict_types=1);

namespace App\ValueObject\Auth;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\Post;
use App\Action\Auth\ResetPassword as ResetPasswordAction;
use App\Entity\Auth\User;
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
    graphQlOperations: [
    ]
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
