<?php

namespace Application\Model;

use Application\Entity\Day;
use Application\Entity\Patient;
use Application\Entity\Stream;
use Application\Entity\Schedule;

class DayModel extends EntityModel {
   
    /**
     * @var Day
     */
    public function get(Patient $patient, $date) {
        $schedule = $patient->getSchedule();
        if(!$schedule) {
            $schedule = new Schedule($this->mandango);
            $patient->setSchedule($schedule);
            $schedule->save();
        }
        $days = $schedule->getDays();
        $foundDay = null;
        foreach ($days as $day) {
            if($day->getDate() == $date) {
                $foundDay = $day;
                break;
            }
        }
        if(!$foundDay) {
            $foundDay = $this->createDay($date);
            $schedule->addDays($foundDay);
            $foundDay->save();
        }
        return $foundDay;
    }
    
    public function getAll() {
        $days = $this->dayRepository()->createQuery()->all();
        return $days;
    }
    
    public function clear() {
        $this->dayRepository()->remove();
    }
    
    protected function createDay($date) {
        $day = new Day($this->mandango);
        $day->setDate($date);
        $streamDiet = $this->createStream('diet');
        $streamExercises = $this->createStream('exercises');
        $streamMedicines = $this->createStream('medicines');
        $streamVisits = $this->createStream('visits');
        $streams = [$streamDiet, $streamExercises, $streamMedicines, $streamVisits];
        $day->addStreams($streams);
        foreach ($streams as $stream) {
            $stream->save();
        }
        return $day;
    }
    
    protected function createStream($activity) {
        $stream= new Stream($this->mandango);
        $stream->setActivity($activity);
        return $stream;
    }
    
}
