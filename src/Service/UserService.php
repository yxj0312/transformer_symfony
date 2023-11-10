<?php
namespace App\Service;

   use App\Repository\UserRepository;

   class UserService
   {
       private $userRepository;

       public function __construct(UserRepository $userRepository)
       {
           $this->userRepository = $userRepository;
       }

       public function createUser($userData)
       {
           // Logic to create a user
       }

       // Other user-related operations
   }