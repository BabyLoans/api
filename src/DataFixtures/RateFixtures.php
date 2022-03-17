<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Repository\TokenRepository;
use App\Entity\Rate;

class RateFixtures extends Fixture implements DependentFixtureInterface
{
    private TokenRepository $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $tokens = $this->tokenRepository->findAll();

        foreach ($tokens as $token) {
            for ($index = 0; $index < 10; $index++) {
                $rate = new Rate();
                $rate->setToken($token)
                    ->setValue(random_int(1, 100))
                    ->setCreatedAt((new \DateTime())->modify("-$index days"));

                if ($index === 0) {
                    $rate->setIsCurrent(true);
                } else {
                    $rate->setIsCurrent(false);
                }

                $manager->persist($rate);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TokenFixtures::class,
        ];
    }
}
