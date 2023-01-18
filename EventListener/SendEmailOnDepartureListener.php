<?php  

namespace App\EventListener;

use App\Entity\Calendar;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SendEmailOnDepartureListener implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            Calendar::EVENT_DEPARTURE => 'departure',
        ];
    }

    public function onDeparture(GenericEvent $event)
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