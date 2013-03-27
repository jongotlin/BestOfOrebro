<?php

namespace JGI\Bundle\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function getPostsForFirstPage()
    {
        $date = new \DateTime();
        return $this->createQueryBuilder('p')
            ->select(['p', 'm'])
            ->innerJoin('p.media', 'm')
            ->where('p.date > :date')
            ->setParameter('date', $date->modify('-1 day'))
            ->setMaxResults(3*9)
            ->orderBy('p.facebookLikes + p.twitterShares', 'desc')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getPostsForSocialUpdate()
    {
        $date = new \DateTime();
        return $this->createQueryBuilder('p')
            ->setMaxResults(200)
            ->where('p.date > :date')
            ->setParameter('date', $date->modify('-10 day'))
            ->orderBy('p.updatedAt', 'asc')
            ->getQuery()
            ->getResult()
        ;        
    }
}
