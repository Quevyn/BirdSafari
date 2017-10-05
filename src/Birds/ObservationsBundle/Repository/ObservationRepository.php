<?php

namespace Birds\ObservationsBundle\Repository;

/**
 * ObservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ObservationRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param $number Nombre de résultats à afficher
     * @return array
     */
    public function findLastValid($number)
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('o')
            ->from('BirdsObservationsBundle:Observation','o')
            ->where('o.valid = :val')
            ->setParameter('val',true)
            ->orderBy('o.id','DESC')
            ->setMaxResults($number);
        return $qb->getQuery()->getResult();

    }

    /**
     * @param $user Utilisateur dont il faut récupérer l
     * @param $valid boolean : true récupère les observations valides.
     * @return array Les observations valides de l'utilisateur
     */
    public function findByAuthorValid($user,$valid)
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('o')
            ->from('BirdsObservationsBundle:Observation','o')
            ->where('o.valid = :val')
            ->setParameter('val',$valid)
            ->andWhere('o.user = :user')
            ->setParameter('user',$user);

        return $qb->getQuery()->getResult();
    }


}
