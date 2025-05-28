<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $arraycategories = [
            1=>[
                "title" => "cinema",
                "slug" => "cinema",
                "parent" => [
                    1 => [
                        "title" => "Fantastique",
                        "slug" => "Fantastique"
                    ],
                    2 => [
                        "title" => "Horreur",
                        "slug" => "Horreur"
                    ]
                ]
            ],

            2=>[
                "title" => "théatre",
                "slug" => "théatre",
                "parent" => [
                    1 => [
                        "title" => "Tragedie",
                        "slug" => "Tragedie"
                    ],
                    2 => [
                        "title" => "Burlesque",
                        "slug" => "Burlesque"
                    ]
                ]
            ]
        ];

        foreach ($arraycategories as $item) {

           $categories = new Categories;
           $categories->setName($item ['title']);
           $categories->setSlug($item ['slug']);
           $categories->setParent(null);

           $manager->persist($categories);

           foreach($item ['parent'] as $key => $value){

            $toto = new Categories;
            $toto->setName($value ['title']);
            $toto->setSlug($value ['slug']);
            $toto->setParent($categories);

            $manager->persist($toto);
           }
           
        }

        $manager->flush();
    }
}
