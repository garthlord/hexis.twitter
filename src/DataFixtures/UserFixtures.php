<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('goranceko11@gmail.com');
        $user->setRoles(['ROLE_SUPERUSER']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'super_password'));
        $manager->persist($user);
        
        $data = [
            ['email' => 'ivan@hexis.com', 'password' => 'ivan',],
            ['email' => 'sinisa@hexis.com', 'password' => 'sinisa',],
        ];
        
        foreach($data as $i)
        {
            $user = new User();
            $user->setEmail($i['email']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $i['password']));
            $manager->persist($user);
        }
        
        $manager->flush();
    }   
}
