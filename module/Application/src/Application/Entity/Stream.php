<?php

namespace Application\Entity;

/**
 * Application\Entity\Stream document.
 */
class Stream extends \Application\Entity\Base\Stream
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => (string)$this->getId());

        $array['activity'] = $this->getActivity();
        
        $mandango = $this->getMandango();
        $eventRepository = new EventRepository($mandango);
        $eventsReferences = $this->getEvents_reference_field();
        $events = [];
        if($eventsReferences) {
            foreach ($eventsReferences as $eventReference) {
                $event = $eventRepository->findOneById($eventReference);
                array_push($events, $event->toArray(true));
            }
        }
        $array['events'] = $events;

        return $array;
    }
    
}