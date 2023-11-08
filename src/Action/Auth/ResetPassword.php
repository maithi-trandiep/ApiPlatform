<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Repository\UserRepository;
use App\ValueObject\ResetPassword as ResetPasswordDTO;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mailer\MailerInterface;

#[AsController]
class ResetPassword
{
    public function __construct(
        protected MailerInterface $mailer,
        protected UserRepository $userRepository,
    )
    {
    }

    public function __invoke(ResetPasswordDTO $dto)
    {
        $user = $this->userRepository->findOneBy(['email' => $dto->getEmail()]);

        if (null === $user) {
            throw new EntityNotFoundException('email not found');
        }

//        $message = new Message();
//        $this->mailer->send($message);

        return $user;
    }
}
