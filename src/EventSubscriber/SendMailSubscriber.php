<?php 

namespace App\EventSubscriber;

use App\Events\MailEvent;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SendMailSubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $entityManager;

    public function __construct(MailerInterface $mailer, EntityManagerInterface $entityManager)
    {
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
    } 

    public static function getSubscribedEvents()
    {
        return [
            'sendMail.customer' => 'sendMailToCustomer',
            'sendMail.supplier' => 'sendMAilToSupplier',
        ];
    }

    public function sendMailToCustomer(MailEvent $mailEvent)
    {
        $calendar = $mailEvent->getCalendar();
        $this->entityManager->persist($calendar);
        $this->entityManager->flush();
            $email = (new Email())
                ->from(new Address('logistique@qualiservice.fr', "service Logistique"))
                ->to('developpement@qualiservice.fr')
                ->subject('Confirmation départ camion')
                ->text('Nous vous informons le Depart ce jour : de votre camion.');
                $this->mailer->send($email);
            

    }
    public function sendMAilToSupplier(MailEvent $mailEvent)
    {
        $calendar = $mailEvent->getCalendar();
        $this->entityManager->persist($calendar);
        $this->entityManager->flush();
            $email = (new Email())
                ->from(new Address('logistique@qualiservice.fr', "service Logistique"))
                ->to('developpement@qualiservice.fr')
                ->subject('Confirmation départ camion')
                ->text('Nous vous informons le Depart ce jour : de votre camion.');
                $this->mailer->send($email);
            

    }
}