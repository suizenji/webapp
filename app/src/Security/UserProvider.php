<?php

namespace App\Security;

use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

class UserProvider extends EntityUserprovider
{
    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        $refreshedUser = parent::refreshUser($user);
        $refreshedUser->setRoles($user->getRoles());
        return $refreshedUser;
    }
}
