<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BanUser extends AbstractController
{
    public function __invoke(User $user)
    {
        // Envoi d'un email comme quoi le compte est banni
        // Modification du status de l'utilisateur
        // Désactivation des prélévements
        // ...

        return $user;
    }
}
