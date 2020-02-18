<?php

namespace App\DataFixtures;

use App\Entity\AContract;
use App\Entity\ContractField;
use App\Entity\ContractType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $contractTypeVoiture  = new ContractType();
        $contractFields = [];

        for($i=0; $i<3 ; $i++){
            $contractField[$i] = new ContractField();
            $contractField[$i]->setName($faker->word);
            $contractField[$i]->setFType('string');
            $contractTypeVoiture->addField($contractField[$i]);
        }

        $contractTypeVoiture->setName('Loc voiture');
        $contractTypeVoiture->setIsCreated(true);

        $manager->persist($contractTypeVoiture);


        $manager->flush();
    }


}
