<?php  

namespace App\EventSubscriber;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SendEmailSubscriber implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            'sendMailCustomer' => ['onDeparture']
        ];
    }

    public function onDeparure(GenericEvent $event)
    {
        $calendar = $event->getSubject();
        $departure = $calendar->getDeparture();

        $email = (new Email())
            ->from('logistique@qualiservice.fr')
            ->to('guihome02@gmail.com')
            ->subject('Departure Confirmation')
            ->text('Departure on '.$departure->format('Y-m-d H:i:s').'has been confirmed.')
        ;

        $this->mailer->send($email);
    }
}