<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Publication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = \Faker\Factory::create();
        
        $mainCategories = [];
        for ($i = 0; $i < 5; $i++) {
            $categorie = new Categorie();
            $categorie->setNomcategorie($faker->word());
            $categorie->setIsEnabled(true);
            $manager->persist($categorie);

            $mainCategories[] = $categorie;

            for($j = 0; $j < 3; $j++) {
              $publication = new Publication();
              $publication->setTitre($faker->sentence(3));
              $publication->setContenue($faker->paragraph());
              $publication->setCategorie($categorie);
              $publication->setPostAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 years', 'now')));
              $publication->setIsPublished($faker->boolean(false));
              $manager->persist($publication);
            }
        }

        $manager->flush();
    }
}
