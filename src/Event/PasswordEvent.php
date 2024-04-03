<?php

namespace App\Event;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordEvent implements EventSubscriberInterface
{
    private $passwordHasher;
    private $entityManager;
    private $requestStack;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => 'beforeEntityUpdated',
            BeforeEntityPersistedEvent::class => 'beforeEntityPersisted',
        ];
    }

    public function beforeEntityUpdated(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof User) {
            $request = $this->requestStack->getCurrentRequest();
            $formData = $request->request->get('entity');

            if (isset($formData['password'])) {
                $plainPassword = $formData['password'];
                $hashedPassword = $this->passwordHasher->hashPassword($entity, $plainPassword);
                $entity->setPassword($hashedPassword);
            }

            $this->entityManager->flush();
        }
    }

    public function beforeEntityPersisted(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof User) {

            $plainPassword = $entity->getPassword();
            $hashedPassword = $this->passwordHasher->hashPassword($entity, $plainPassword);
            $entity->setPassword($hashedPassword);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        }
    }
}

