<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Message;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{


    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        //Category fixture
        $categoryName = ["Grabs", "Rotations", "Flips", "Rotations désaxées", "Slides", "One foot tricks", "Old school"];
        foreach ($categoryName as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }
        $manager->flush();
        $categoryRepository = $manager->getRepository(Category::class);

        //User fixture
        $user = new User();
        $user->setEmail("admin@snowtrick.fr")
            ->setPassword($this->passwordHasher->hashPassword($user, "motdepasse"))
            ->setUsername("Admin");

        //trick fixtures
        $tricksData = [
            [
                "name" => "Mute",
                "description" => "Saisie de la carre frontside de la planche entre les deux pieds avec la main avant",
                "category" => $categoryRepository->findOneBy(array('Name' => "Grabs")),
                "user" => $user
            ],
            [
                "name" => "Sad",
                "description" => "Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant",
                "category" => $categoryRepository->findOneBy(array('Name' => "Grabs")),
                "user" => $user
            ],
            [
                "name" => "Indy",
                "description" => "Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière",
                "category" => $categoryRepository->findOneBy(array('Name' => "Grabs")),
                "user" => $user
            ],
            [
                "name" => "Stalefish",
                "description" => "Saisie de la carre backside de la planche entre les deux pieds avec la main arrière",
                "category" => $categoryRepository->findOneBy(array('Name' => "Grabs")),
                "user" => $user
            ],
            [
                    "name" => "Tail grab",
                "description" => "Saisie de la partie arrière de la planche, avec la main arrière",
                "category" => $categoryRepository->findOneBy(array('Name' => "Grabs")),
                "user" => $user
            ],
            [
                "name" => "180",
                "description" => "Faites un demi tour !",
                "category" => $categoryRepository->findOneBy(array('Name' => "Rotations")),
                "user" => $user
            ],
            [
                "name" => "Backflip",
                "description" => "Retourner en arrière (comme un backflip debout) après un saut.",
                "category" => $categoryRepository->findOneBy(array('Name' => "Flips")),
                "user" => $user
            ],
            [
                "name" => "Tail slide",
                "description" => "Une glissade effectuée avec le snowboard perpendiculaire à un rail, le talon de la planche glissant le long de l'obstacle.",
                "category" => $categoryRepository->findOneBy(array('Name' => "Slides")),
                "user" => $user
            ],
            [
                "name" => "Nose Press",
                "description" => "Un tour exécuté en se déplaçant tout droit le long d'un obstacle, avec une pression exercée sur le nez de la planche, de sorte que la queue de la planche est soulevée dans les airs.",
                "category" => $categoryRepository->findOneBy(array('Name' => "Slides")),
                "user" => $user
            ],
            [
                "name" => "Zeech",
                "description" => "Un toboggan où le snowboard est pressé tout en glissant perpendiculairement au rail. Les Zeeches appropriés sont exécutés directement sur le pied avant ou arrière. Peut se faire recto ou verso. Si vous faites du Zeeching sur votre pied avant, votre tail sera en l'air le plus haut possible, à l'opposé si c'est fait sur le pied arrière du snowboarder. Le Zeech a été rendu populaire au Windells Camp",
                "category" => $categoryRepository->findOneBy(array('Name' => "Slides")),
                "user" => $user
            ]
            ,
            [
                "name" => "180",
                "description" => "Faites un demi tour !",
                "category" => $categoryRepository->findOneBy(array('Name' => "Rotations")),
                "user" => $user
            ],
            [
                "name" => "Backflip",
                "description" => "Retourner en arrière (comme un backflip debout) après un saut.",
                "category" => $categoryRepository->findOneBy(array('Name' => "Flips")),
                "user" => $user
            ],
            [
                "name" => "Tail slide",
                "description" => "Une glissade effectuée avec le snowboard perpendiculaire à un rail, le talon de la planche glissant le long de l'obstacle.",
                "category" => $categoryRepository->findOneBy(array('Name' => "Slides")),
                "user" => $user
            ],
            [
                "name" => "Nose Press",
                "description" => "Un tour exécuté en se déplaçant tout droit le long d'un obstacle, avec une pression exercée sur le nez de la planche, de sorte que la queue de la planche est soulevée dans les airs.",
                "category" => $categoryRepository->findOneBy(array('Name' => "Slides")),
                "user" => $user
            ],
            [
                "name" => "Zeech",
                "description" => "Un toboggan où le snowboard est pressé tout en glissant perpendiculairement au rail. Les Zeeches appropriés sont exécutés directement sur le pied avant ou arrière. Peut se faire recto ou verso. Si vous faites du Zeeching sur votre pied avant, votre tail sera en l'air le plus haut possible, à l'opposé si c'est fait sur le pied arrière du snowboarder. Le Zeech a été rendu populaire au Windells Camp",
                "category" => $categoryRepository->findOneBy(array('Name' => "Slides")),
                "user" => $user
            ]
        ];

        foreach ($tricksData as $trick) {
            $trickEntity = new Trick();

            $picture = (new Picture())->setTrick($trickEntity)->setLink("https://img.freepik.com/free-vector/beautiful-gradient-spring-landscape_23-2148448598.jpg?w=2000");
            $video = (new Video())->setLink("<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/P7vcGR8UjBY\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>")->setTrick($trickEntity);
            $message = (new Message())->setContent("Je suis un message de test")->setTrick($trickEntity)->setUser($user);

            $manager->persist($picture);
            $manager->persist($video);
            $manager->persist($message);

            $trickEntity->setName($trick["name"])
                ->setUser($trick["user"])
                ->setDescription($trick["description"])
                ->setCategory($trick["category"])
                ->addPicture($picture)
                ->addVideo($video)
                ->addMessage($message);
            $manager->persist($trickEntity);
        }

        $manager->persist($user);
        $manager->flush();
    }
}
