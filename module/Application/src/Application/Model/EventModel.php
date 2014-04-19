<?php

namespace Application\Model;

use Application\Entity\Day;
use Application\Entity\Event;

class EventModel extends EntityModel {
    
     /**
     * @var \Application\Entity\Event
     */
    public function get($params) {
        $event = $this->eventRepository()->findOneById($params['id']);
        return $event;
    }
    
    public function getAll() {
        $events = $this->eventRepository()->createQuery()->all();
        return $events;
    }
    
    public function clear() {
        $this->eventRepository()->remove();
    }
    
    public function addEvent(Day $day, $params) {
        $streams = $day->getStreams()->all();
        $foundStream = $this->findStream($streams, $params);
        $event = $this->buildEvent($params);
        $foundStream->addEvents($event);
        $event->save();
        return $event;
    }
    
    protected function buildEvent($params) {
        $event = new Event($this->mandango);
        $event->setTitle($params['title']);
        $event->setDetails($params['details']);
        $event->setTime($params['time']);
        $event->setDuration($params['duration']);
        $event->setState('future');
        return $event;
    }
    
    protected function findStream($streams, $params) {
        foreach ($streams as $stream) {
            if($stream->getActivity() == $params['activity']) {
                return $stream;
            }
        }
        return null;
    }
    
}
