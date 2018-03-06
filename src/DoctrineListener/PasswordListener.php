<?php

namespace App\DoctrineListener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * PasswordListener constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {

        $entity = $eventArgs->getEntity();

        if(!$entity instanceof User){

            return;
        }

        $password = $this->encoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($password);
        $entity->setPlainPassword(null);

    }


}