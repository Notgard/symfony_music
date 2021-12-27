<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $root = new User();
        $root->setUsername('root');
        $root->setPassword($this->passwordEncoder->encodePassword(
            $root,
            'password'
        ));
        $root->setRoles((array) 'ROLE_ADMIN');
        $manager->persist($root);
        $user = new User();
        $user->setUsername('user');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'password0'
        ));
        $user->setRoles((array) 'ROLE_USER');
        $manager->persist($user);
        $manager->flush();
    }
}
