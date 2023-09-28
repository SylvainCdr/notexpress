<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Note;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         // On instancie Faker pour générer des données aléatoires en français
         $faker = Factory::create($fakerLocale = 'fr_FR');

         /**
         * Les utilisateurs
         * Traitement pour l'ajout des users
         */
        $objectUser = [];
        // Les utilisateurs
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setUsername($faker->userName())
                ->setPassword($faker->password())
                ->setRoles(['ROLE_USER'])
                ;
            // On ajout l'objet auteur dans le tableau
            array_push($objectUser, $user);
            // On persiste l'objet auteur
            $manager->persist($user);
        }

         $categories = [
            'Travail',
            'Bricolage',
            'Achats',
            'Administratif',
            'Formation',
        ];

         // Les ojects catégories instanciés
         $objectCategory = [];
         // On boucle sur les catégories
         for ($i = 0; $i < count($categories); $i++) {
             $category = new Category;
             $category->setName($categories[$i])
             ->setUser($objectUser[rand(0,19)])
                ;
             // On ajoute l'objet catégorie dans le tableau
             array_push($objectCategory, $category);
             // On persiste l'objet catégorie
             $manager->persist($category);
         }

             /**
         * Les notes
         * Traitement pour l'ajout des notes
         */
        $objectNote = [];
        // Les utilisateurs
        for ($i = 0; $i < 20; $i++) {
            $note = new Note();
            $note->setTitle($faker->title(2))
                ->setContent($faker->sentence(10))
                ->setCategory($objectCategory[rand(0,4)])
                ->setUser($objectUser[rand(0,19)])
                ;
            // On ajout l'objet user dans le tableau
            array_push($objectNote, $note);
            // On persiste l'objet user
            $manager->persist($note);
        }


        $manager->flush();
    }
}
