<?php

namespace App\DataFixtures;

use App\Entity\Stagiaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StagiaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 10; $i++)
        {
            $stagiaire = new Stagiaire;
            //on instancie ma classe article qui se trouve dans le dossier App\Entity
            //Nous pouvons maintenant faire appel au setters pour insérer les données
            $stagiaire->setPrenom("Hugo")
                    ->setNom("Boulhaut")
                    ->setTelephone("06-51-15-73-45")
                    ->setEmail("boulhaut@gmail.com")
                    ->setAdresse("193 Rue de Corlin")
                    ->setPoste("Développeur Informatique")
                    ->setSalaire("20000")
                    -> setDateDeNaissance(new \DateTime("04/05/2000"));

            $manager->persist($stagiaire);
            //persist() permet de faire persister l'article dans le temps et péparer son insertion en BDD
        }
        $manager->flush();
        // flush() permet d'exécuter la requête SQL préparée grâce à persist()
    }
}
