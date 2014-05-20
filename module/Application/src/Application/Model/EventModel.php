<?php

namespace Application\Model;

use Application\Entity\Day;
use Application\Entity\Event;
use Application\Entity\Stream;

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
        $event = $this->buildEvent($params);
        $foundStream = $this->findStream($streams, $params);
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
    
    public function getUndone($params) {
        $results = array();
        $patients = $this->getPatients($params);
        foreach($patients as $patient) {
            $schedule = $patient->getSchedule();
            if(!$schedule) continue;
            $days = $schedule->getDays();
            foreach ($days as $day) {
                $dayDate = $day->getDate();
                $isDateInRange = $this->isDateInRange($dayDate);
                if($isDateInRange) {
                    $streams = $day->getStreams();
                    foreach ($streams as $stream) {
                        $events = $stream->getEvents();
                        foreach ($events as $event) {
                            $state = $event->getState();
                            if($state != 'done') {
                                array_push($results, [
                                    'patient' => $patient->getFirstname() . ' ' . $patient->getLastname(),
                                    'date' => $day->getDate(),
                                    'time' => $event->getTime(),
                                    'activity' => $stream->getActivity(),
                                    'title' => $event->getTitle(),
                                ]);
                            }
                        }
                    }
                }
            }
        }
        return $results;
    }
    
    protected function getPatients($params) {        
        $allPatients = $this->patientRepository()->createQuery()->all();
        $patients = [];
        foreach ($allPatients as $patient) {
            $doctorid = (string)$patient->getDoctor_reference_field();
            if($doctorid == $params['doctorid']){
                array_push($patients, $patient);
            }
        }
        return $patients;
    }
    
    protected function isDateInRange($date) {
        $now = time();
        $convertedDate = str_replace("/", "-", $date);
        $dayDate = strtotime($convertedDate);
        $inRange = $now - $dayDate < 60*60*24*10;
        $inRange = $inRange && $now > $dayDate;
        return $inRange;
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
    
    private function isEventInStream(Stream $stream, Event $event) {
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
