<?php

namespace Application\Model;

use Application\Entity\Day;
use Application\Entity\Stream;
use Application\Entity\Event;
use Application\Entity\Schedule;
use Application\Entity\Patient;

class PatientModel extends EntityModel {
    
    public function get($params) {
        $patient = $this->patientRepository()->findOneById($params['id']);                
        return $patient;
    }
    
    public function getAll() {
        $patients = $this->patientRepository()->createQuery()->all();
        return $patients;
    }
    
    public function getDay($params) {
        $patient = $this->patientRepository()->findOneById($params['patientid']);
        $schedule = $this->getSchedule($patient);
        $day = $this->getDayFromSchedule($schedule, $params);
        return $day;
    }
    
    public function addEvent($params) {
        $patient = $this->patientRepository()->findOneById($params['patientid']);
        $schedule = $this->getSchedule($patient);
        $day = $this->getDayFromSchedule($schedule, $params);
        $stream = $this->getStreamByDay($day, $params);
        $event = $this->addEventToStream($stream, $params);
        $day->save();
        $patient->save();
        return $event;
    }
    
    protected function addEventToStream(Stream $stream, $params) {
        $event = $this->buildEvent($params);
        $stream->addEvents($event);
        return $event;
    }
    
    public function getStream($params) {
        $patient = $this->patientRepository()->findOneById($params['patientid']);
        $schedule = $this->getSchedule($patient);
        $day = $this->getDayFromSchedule($schedule, $params);
        $stream = $this->getStreamByDay($day, $params);
        return $stream;
    }
    
    public function clear() {
        $this->patientRepository()->remove();
    }
    
    //http://localhost/db/event/add?patient=5346c505df722ed41200003a&date=20140410&activity=diet
    protected function buildEvent($params) {
        $event = new Event($this->mandango);
        $event->setTitle($params['title']);
        $event->setDetails($params['details']);
        $event->setTime($params['time']);
        $event->setDuration($params['duration']);
        $event->setState('future');
        return $event;
    }
    
    protected function getDayFromSchedule(Schedule $schedule, $params) {
        $days = $schedule->getDays();
        $foundDay = null;
        foreach($days as $day) {
            if($day->getDate() == $params['date']) {
                $foundDay = $day;
            }
        }
        if(!$foundDay) {
            $foundDay = new Day($this->mandango);
            $foundDay->setDate($params['date']);
            $schedule->addDays([$foundDay]);
            $foundDay->save();
        }
        return $foundDay;
    }
    
    protected function getStreamByDay(Day $day, $params) {
        $streams = $day->getStreams();
        if(!$streams) {
            $streams = array();
        }
        $foundStream = null;
        foreach($streams as $stream) {
            if($stream->getActivity() == $params['activity']) {
                $foundStream = $stream;
            }
        }
        if(!$foundStream) {
            $foundStream = new Stream($this->mandango);
            $foundStream->setActivity($params['activity']);
            $day->addStreams($foundStream);
            $day->save();
        }
        return $foundStream;
    }
    
    protected function getSchedule(Patient $patient) {
        $schedule = $patient->getSchedule();
        if(!$schedule) {
            $schedule = $this->createSchedule();
            $patient->setSchedule($schedule);
            $patient->save();
        }
        return $schedule;
    }
    
    protected function createSchedule() {
        $schedule = new Schedule($this->mandango);
        $foundDay = new Day($this->mandango);
        $foundDay->setDate('date');
        $foundDay->save();
        $schedule->addDays($foundDay);
        return $schedule;
    }
    
}
