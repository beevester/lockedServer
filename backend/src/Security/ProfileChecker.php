<?php


namespace App\Security;

use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileChecker implements UserCheckerInterface
{
    /**
     * @inheritDoc
     */
    public function checkPreAuth(UserInterface $identity): void
    {
        if (!$identity instanceof ProfileByEmail) {
            return;
        }

        if (!$identity->isActive()) {
            $exception = new DisabledException('User account is disabled.');
            $exception->setUser($identity);
            throw $exception;
        }
    }

    /**
     * @inheritDoc
     */
    public function checkPostAuth(UserInterface $identity): void
    {
        if (!$identity instanceof ProfileByEmail) {
            return;
        }
    }
}
