<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findAllWithPaginator($limit = 10, $currentPage = 1)
    {
        $query = $this->createQueryBuilder('p')
            ->innerJoin("p.user", "u")
            ->where('p.active = 1')
            ->orderBy('p.created_at', 'DESC')
            ->getQuery();

        $paginator = $this->paginate($query, $limit, $currentPage);

        return $paginator;
    }

    public function paginate($dql, $limit, $page = 1)
{
    $paginator = new Paginator($dql);

    $paginator->getQuery()
        ->setFirstResult($limit * ($page - 1))
        ->setMaxResults($limit);

    return $paginator;
}
}
