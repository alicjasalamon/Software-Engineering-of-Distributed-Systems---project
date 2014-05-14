<?php

namespace Application\Model;

use Application\Entity\Day;
use Application\Entity\Event;

class EventModel extends EntityModel {
    
     /**
     * @var Event
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
    
    public function setState($params) {
        $event = $this->get($params);
        $event->setState($params['state']);
        $event->save();
        return $event;
    }
    
    public function setMeasurementValue($params) {
        $event = $this->get($params);
        $event->setMeasurementvalue($params['measurementvalue']);
        $event->save();
        return $event;
    }
    
    public function deleteEvent($params) {
        $event = $this->get($params);
        $stream = $this->getStreamByEvent($event);
        $events = $stream->getEvents();
        $events->remove($event);
        $stream->save();
        $event->delete();
        return null;
    }
    
    protected function buildEvent($params) {
        $event = new Event($this->mandango);
        $event->setTitle($params['title']);
        $event->setDetails($params['details']);
        $event->setTime($params['time']);
        $event->setDuration($params['duration']);
        $event->setState('future');
        if(array_key_exists('measurement', $params)) {
            $event->setMeasurement($params['measurement']);
        }
        return $event;
    }
    
    private function findStream($streams, $params) {
        foreach ($streams as $stream) {
            if($stream->getActivity() == $params['activity']) {
                return $stream;
            }
        }
        return null;
    }
    
    private function getStreamByEvent(Event $event) {
        $streams = $this->streamRepository()->createQuery()->all();
        foreach ($streams as $stream) {
            if($this->isEventInStream($stream, $event)){
                return $stream;
            }
        }
        return null;
    }
    
    private function isEventInStream(\Application\Entity\Stream $stream, Event $event) {
        $id = (string)$event->getId();
        $events = $stream->getEvents();
        foreach ($events as $e) {
            $currentId = (string)$e->getId();
            if($currentId == $id) {
                return true;
            }
        }
        return false;
    }
    
}
