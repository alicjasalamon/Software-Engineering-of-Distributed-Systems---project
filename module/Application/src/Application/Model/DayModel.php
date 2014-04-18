<?php

namespace Application\Model;

use Application\Entity\Day;
use Application\Entity\Patient;
use Application\Entity\Stream;

class DayModel extends EntityModel {
   
    /**
     * @var Day
     */
    public function get(Patient $patient, $date) {
        $schedule = $patient->getSchedule();
        if(!$schedule) {
            $schedule = $this->mandango->create('Application\Entity\Schedule');
            $patient->setSchedule($schedule);
            $schedule->save();
            $patient->save();
        }
        $days = $schedule->getDays()->all();
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
        $streamDiet = new Stream($this->mandango);
        $streamDiet->setActivity('diet');
        $streamMedicines = new Stream($this->mandango);
        $streamMedicines->setActivity('medicines');
        $streamExercises = new Stream($this->mandango);
        $streamExercises->setActivity('exercises');
        $streamVisits = new Stream($this->mandango);
        $streamVisits->setActivity('visits');
        $day->addStreams([
            $streamDiet,
            $streamExercises,
            $streamMedicines,
            $streamVisits,
        ]);
        return $day;
    }
    
}
