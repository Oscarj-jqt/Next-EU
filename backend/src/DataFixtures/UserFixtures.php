<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\CountryEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $usersData = [
            [
                'username' => 'Leander',
                'password' => '123456',
                'country' => CountryEnum::GERMANY->value,
                'profilePicture' => 'profile2.jpg',
            ],
            [
                'username' => 'Oscar',
                'password' => '123456',
                'country' => CountryEnum::FRANCE->value,
                'profilePicture' => 'profile1.jpg',
            ],
        ];

        foreach ($usersData as $userData) {
            $user = new User();
            $user->setUsername($userData['username']);
            $user->setCountry(CountryEnum::from($userData['country']));
            $user->setProfilePicture($userData['profilePicture']);
            $user->setCreatedAt(new \DateTimeImmutable());

            $hashedPassword = $this->passwordHasher->hashPassword($user, $userData['password']);
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
