<?php

namespace App\Entity;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class Account implements UserInterface, PasswordAuthenticatedUserInterface, PasswordHasherAwareInterface {

}