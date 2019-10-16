<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**
     * Undocumented variable
     *
     * @var UserPasswordEncoderInterface
     */    
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User;
        $user->setUsername("David313")
             ->setPassword($this->encoder->encodePassword($user, 'demo'));
        $manager->persist($user);
        $manager->flush();
    }
}
