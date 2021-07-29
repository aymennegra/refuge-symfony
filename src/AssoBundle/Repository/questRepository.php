<?php

namespace AssoBundle\Repository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Doctrine\ORM\EntityRepository;
/**
 * chatbotRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class questRepository extends \Doctrine\ORM\EntityRepository
{

    public function getquest()
    {
        $q = $this->getEntityManager()->createQuery("SELECT u.id,u.quest, u.rep ,AVG(u.val) f FROM AssoBundle:question u where u.user='admin' group by u.quest order by f desc ");
        return $query = $q->getResult();
    }
    public function getquestmob()
    {
        $q = $this->getEntityManager()->createQuery("SELECT u.id,u.idquest,u.quest, u.rep,u.user ,AVG(u.val) f FROM AssoBundle:question u where u.user='admin' group by u.quest order by f desc ");
        return $query = $q->getResult();
    }


    public function findnotif()
    {
        $q = $this->getEntityManager()->createQuery("SELECT  u FROM AssoBundle:Notification u  where u.user=:'now' ");
       //     ->getParameter('user', $usr);
        return $query = $q->getResult();
    }



    public function getmoy()
    {
        $q = $this->getEntityManager()->createQuery("SELECT u FROM AssoBundle:question u  group by u.quest having  AVG(u.val) < 3 ");
        return $query = $q->getResult();
    }


    public function verif2($id, $username)
    {

        $q = $this->getEntityManager()->createQuery(
            "select u from AssoBundle:question u where u.id =:id and u.user=:username")
            //      ->getParameter('id',$id)
            ->getParameter('id', $id)
            ->getParameter('username', $username);
        return $query = $q->getResult();

    }


    public function verif($questt, $username)
    {

        $q = $this->getEntityManager()->createQuery("select u from AssoBundle:question u where (u.quest=:quest) and (u.user=:username )")

            ->setParameter('quest', $questt)
//            ->setParameter('rep', $rep)
            ->setParameter('username', $username);

        return $query = $q->getResult();
    }


    public function findEntitiesByString1($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p from AssoBundle:question p where  p.quest LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
          //  ->setParameter('roles', '%"'."Role_ASSOCIATION".'"%')
            ->getResult();
    }

    public function findbyuser($a,$b)
    {

        $q = $this->getEntityManager()->createQuery("select u from AssoBundle:question u where  u.user !='admin' and (u.val>=:a) and (u.val<=:b) ")
        ->setParameter('a', $a)
        ->setParameter('b', $b);


        return $query = $q->getResult();
    }
    public function findbyadmin()
    {

        $q = $this->getEntityManager()->createQuery("select u from AssoBundle:question u where  u.user ='admin' ");


        return $query = $q->getResult();
    }
    public function findusradmin()
    {$q = $this->getEntityManager()->createQuery("select u from UserBundle:User u where  u.roles='a:1:{i:0;s:16:\"ROLE_ASSOCIATION\";}' ");
        return $query = $q->getResult();}



    public function findquestmob($h)
    {
        $q = $this->getEntityManager()->createQuery("SELECT u.id,u.idquest,u.quest, u.rep,u.user ,u.val f FROM AssoBundle:question u where u.idquest=:h ")
        ->setParameter('h', $h);
        return $query = $q->getResult();
    }
    public function findquestmob2($h,$login)
    {
        $q = $this->getEntityManager()->createQuery("SELECT u.id,u.idquest,u.quest, u.rep,u.user ,u.val f FROM AssoBundle:question u where u.idquest=:h  and u.user=:login and u.user !='admin'")
            ->setParameter('h', $h)
        ->setParameter('login', $login);
        return $query = $q->getResult();
    }


}