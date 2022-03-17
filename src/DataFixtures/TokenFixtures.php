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
            ->setLogoUrl("https://media.discordapp.net/attachments/907921129589600277/953963429151010816/bnb_logo.png")
            ->setSymbol("BNB");

        $manager->persist($token);

        $token = new Token();
        $token->setColor("#26a17c")
            ->setLogoUrl("https://media.discordapp.net/attachments/907921129589600277/953963430090518568/usdt_logo.png")
            ->setSymbol("USDT");

        $manager->persist($token);

        $token = new Token();
        $token->setColor("#2277ca")
            ->setLogoUrl("https://media.discordapp.net/attachments/907921129589600277/953963429847261204/usdc_logo.png")
            ->setSymbol("USDC");

        $manager->persist($token);

        $token = new Token();
        $token->setColor("#f0ba17")
            ->setLogoUrl("https://media.discordapp.net/attachments/907921129589600277/953963429339758652/busd_logo.png")
            ->setSymbol("BUSD");

        $manager->persist($token);

        $token = new Token();
        $token->setColor("#fab218")
            ->setLogoUrl("https://media.discordapp.net/attachments/907921129589600277/953963429557833748/dai_logo.png")
            ->setSymbol("DAI");

        $manager->persist($token);

        $token = new Token();
        $token->setColor("#5301fd")
            ->setLogoUrl("https://cdn.discordapp.com/attachments/907921129589600277/953963430325407794/bbl_logo.png")
            ->setSymbol("BBL");

        $manager->persist($token);

        $manager->flush();
    }
}
