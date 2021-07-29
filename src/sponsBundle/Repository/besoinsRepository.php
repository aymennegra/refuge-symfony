<?php

namespace sponsBundle\Repository;

use sponsBundle\Entity\besoins;

/**
 * besoinsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class besoinsRepository extends \Doctrine\ORM\EntityRepository
{
    public function findbesoins()
    {
        $q = $this->getEntityManager()->createQuery("SELECT s from stockBundle:stock s where s.quantiteDispo<'100' " );
        $query = $q->getResult();



        return $query;
    }
    public function findbesoinsbynomproduit($nom)
    {
        $q = $this->getEntityManager()->createQuery("SELECT b from sponsBundle:besoins b where b.nomProduit=:nom " )
        ->setParameter('nom',$nom);
        $query = $q->getResult();

        return $query;
    }
    public function  update($nom_produit,$bs,$quantite){
        $qb=$this->getEntityManager()->createQueryBuilder()
            ->update('sponsBundle:besoins','b')
            ->set('b.nosBesoins', (100-$quantite)-$bs)
            ->set('b.quantiteDispo',$quantite+$bs)
            ->where('b.nomProduit =?1')
            ->setParameter(1 ,$nom_produit)
            ->getQuery()
            ->execute();
        return $qb;
    }
    public function  updateStock($nom_produit,$quantite){
        $qb=$this->getEntityManager()->createQueryBuilder()
            ->update('stockBundle:stock','s')
            ->set('s.quantiteDispo',$quantite)
            ->where('s.nomProduit =?1')
            ->setParameter(1 ,$nom_produit)
            ->getQuery()
            ->execute();
        return $qb;
    }
    public function  deleteBes($nom_produit){
        $qb=$this->getEntityManager()->createQueryBuilder()
            ->delete('sponsBundle:besoins','b')
            ->where('b.nomProduit =?1')
            ->setParameter(1 ,$nom_produit)
            ->getQuery()
            ->execute();
        return $qb;
    }
}
