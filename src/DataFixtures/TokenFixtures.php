<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Token;

class TokenFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $token = new Token();
        $token->setColor("#f0ba17")
            ->setLogoUrl("https://assets.coingecko.com/coins/images/825/thumb_2x/bnb-icon2_2x.png?1644979850%202x")
            ->setSymbol("BNB");

        $manager->persist($token);

        $token = new Token();
        $token->setColor("#26a17c")
            ->setLogoUrl("https://assets.coingecko.com/coins/images/325/thumb_2x/Tether-logo.png?1598003707%202x")
            ->setSymbol("USDT");

        $manager->persist($token);

        $token = new Token();
        $token->setColor("#2277ca")
            ->setLogoUrl("https://assets.coingecko.com/coins/images/6319/thumb_2x/USD_Coin_icon.png?1547042389%202x")
            ->setSymbol("USDC");

        $manager->persist($token);

        $token = new Token();
        $token->setColor("#f0ba17")
            ->setLogoUrl("https://assets.coingecko.com/coins/images/9576/thumb_2x/BUSD.png?1568947766%202x")
            ->setSymbol("BUSD");

        $manager->persist($token);

        $token = new Token();
        $token->setColor("#fab218")
            ->setLogoUrl("https://assets.coingecko.com/coins/images/9956/thumb_2x/4943.png?1636636734%202x")
            ->setSymbol("DAI");

        $manager->persist($token);

        $manager->flush();
    }
}
