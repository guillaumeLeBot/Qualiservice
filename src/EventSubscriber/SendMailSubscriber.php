<?php 

namespace App\EventSubscriber;

use App\Events\MailEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class SendMailSubscriber implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    } 

    public static function getSubscribedEvents()
    {
        return [
            'sendMail.customer' => 'sendMailToCustomer',
        ];
    }

    public function sendMailToCustomer(MailEvent $mailEvent)
    {
            $email = (new Email())
                ->from(new Address('logistique@qualiservice.fr', "service Logistique"))
                ->to('developpement@qualiservice.fr')
                ->subject('Confirmation départ camion')
                ->text('Nous vous informons le Depart ce jour : de votre camion.'.$mailEvent->getCalendar()->getDeparure()->format('d-m-Y'));
            $this->mailer->send($email);
            // $email = new Email();
            // $email->from(new Address("developpement@qualiservice.fr", "Qualiservice"))
            //         ->to("client@gmail.com")
            //         ->text("Votre camion est bien parti de nos Entrepôts".$mailEvent->getCalendar()->getDeparure()->format('d-m-Y'))
            //         ->subject("Départ Camion");
            // $this->mailer->send($email);

            // dd($email);

    }
}