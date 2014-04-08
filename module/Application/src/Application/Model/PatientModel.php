<?php

namespace Application\Model;
use Application\Entity\Day;
use Application\Entity\Stream;
use Application\Entity\Event;
use Application\Entity\Schedule;

class PatientModel extends EntityModel {
    
    public function get($params) {
        $patient = $this->patientRepository()->findOneById($params['id']);
        return $patient;
    }
    
    public function getAll() {
        $patients = $this->patientRepository()->createQuery()->all();
        return $patients;
    }
    
    public function addEvent($params) {
        $patient = $this->patientRepository()->findOneById($params['patient']);
        $schedule = $patient->getSchedule();
        if(!$schedule) {
            $schedule = $this->createSchedule();
            $patient->setSchedule($schedule);
        }
        $day = $this->getDay($schedule, $params);
        $stream = $this->getStream($day, $params);
        $event = $this->buildEvent($params);
        $stream->addEvents($event);
        $patient->save();
        return $event;
    }
    
    public function clear() {
        $this->patientRepository()->remove();
    }
    
    protected function buildEvent($params) {
        $event = new Event($this->mandango);
    }
    
    protected function getDay($schedule, $params) {
        $days = $schedule->getDays();
        $foundDay = null;
        foreach($days as $day) {
            if($day['date'] == $params['date']) {
                $foundDay = $day;
            }
        }
        if(!$foundDay) {
            $foundDay = new Day($this->mandango);
            $foundDay->setDate($params['date']);
            $schedule->addDay($foundDay);
        }
        return $foundDay;
    }
    
    protected function getStream($day, $params) {
        $streams = $day->getStreams();
        if(!$streams) {
            $streams = array();
        }
        $foundStream = null;
        foreach($streams as $stream) {
            if($stream['activity'] == $params['activity']) {
                $foundStream = $stream;
            }
        }
        if(!$foundStream) {
            $foundStream = new Stream($this->mandango);
            $foundStream->setActivity($params['activity']);
            $day->addStreams($foundStream);
        }
        return $foundStream;
    }
    
    protected function createSchedule() {
        $schedule = new Schedule($this->mandango);
        return $schedule;
    }
    
}
