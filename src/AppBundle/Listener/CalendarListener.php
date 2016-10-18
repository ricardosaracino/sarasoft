<?php
/**
 * @author Ricardo Saracino
 * @since 10/18/16
 */

namespace AppBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AppBundle\Event\CalendarEvent as Event;

/**
 * Class CalendarListener
 * @package AppBundle\Listener
 */
class CalendarListener
{
	/**
	 * @param CalendarEvent $calendarEvent
	 *
	 * @return EventInterface[]
	 */
	public function loadData(CalendarEvent $calendarEvent)
	{
		$startDate = $calendarEvent->getStartDatetime();
		$endDate = $calendarEvent->getEndDatetime();
		$filters = $calendarEvent->getFilters();

		//You may want do a custom query to populate the events

		$calendarEvent->addEvent(new Event('Event Title 1', new \DateTime()));
		$calendarEvent->addEvent(new Event('Event Title 2', new \DateTime()));
	}
}