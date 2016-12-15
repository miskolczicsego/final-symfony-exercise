<?php

namespace JobZ\HomeBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * JobRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class JobRepository extends EntityRepository
{
    /**
     * @param $category
     * @return array
     */
    public function getLastActiveJobsByCategory($category)
    {
        $qb = $this->getQueryBuilder()
            ->where('j.category = :category')
            ->andWhere('j.status = 1')
            ->setParameter('category', $category)
            ->setMaxResults(10)
            ->orderBy('j.createdAt')
            ->getQuery();
        return $qb->getResult();
    }

    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();
        $qb = $em->getRepository('HomeBundle:Job')
            ->createQueryBuilder('j');
        return $qb;
    }
}
