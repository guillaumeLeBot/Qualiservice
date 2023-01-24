<?php 

namespace App\Events;

use App\Entity\Calendar;
use Symfony\Contracts\EventDispatcher\Event;

class MailEvent extends Event
{
    private $calendar;
    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    public function getCalendar()
    {
        return $this->calendar;
    }
}