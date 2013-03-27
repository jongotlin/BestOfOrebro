<?php

namespace JGI\Bundle\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MediaRepository extends EntityRepository
{
    public function getMediaForImport()
    {
        return $this->createQueryBuilder('m')
            ->setMaxResults(1)
            ->orderBy('m.updatedAt', 'asc')
            ->getQuery()
            ->getSingleResult()
        ;
    }
}
