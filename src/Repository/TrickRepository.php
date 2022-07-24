<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Trick>
 *
 * @method Trick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trick[]    findAll()
 * @method Trick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    public function add(Trick $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Trick $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function updateTrickById(int $id, string $description, Category $category)
    {
        $trickEntity = $this->find($id);
        if (!empty($trickEntity)) {
            $trickEntity->setDescription($description);
            $trickEntity->setCategory($category);
            $this->getEntityManager()->flush();
        }
    }

    public function updateTrickByEntity(Trick $trick, array $mediaUpdated)
    {

        $baseTrick = $this->find($trick->getId());
        dump($baseTrick);
        $baseTrick->setDescription($trick->getDescription())
            ->setCategory($trick->getCategory());

        if (!empty($mediaUpdated)) {
            if ($mediaUpdated["type"] === "picture") {
                $picture = $this->getEntityManager()->getRepository(Picture::class)->find($mediaUpdated["id"]);
                if ($picture) $this->getEntityManager()->persist($picture->setLink($mediaUpdated["url"]));
                dd($picture);
            } else {
                $video = $this->getEntityManager()->getRepository(Video::class)->find($mediaUpdated["id"]);
                if ($video) $this->getEntityManager()->persist($video->setLink($mediaUpdated["url"]));
                dd($video);
            }
        }
        dd($baseTrick);
        $this->getEntityManager()->persist($baseTrick);
        $this->getEntityManager()->flush();
    }


//    /**
//     * @return Trick[] Returns an array of Trick objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Trick
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
