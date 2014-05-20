<?php

namespace Application\Model;

use Application\Model\EntityModel;
use Application\Entity\Patient;
use Application\Entity\Day;

class MeasurementsModel extends EntityModel {
    
    public function get($params) {
        $results = [];
        $patients = $this->getPatients($params);
        foreach ($patients as $patient) {
            
            $schedule = $patient->getSchedule();
            if(!$schedule) continue;
            $days = $schedule->getDays();
            echo count($days);
            foreach ($days as $day) {
                $dayDate = $day->getDate();
                echo 'x';
                $isDateNoOlderThan10Days = $this->isDateNoOlderThan10Days($dayDate);
                echo $isDateNoOlderThan10Days;
                if($isDateNoOlderThan10Days) {
                    $dayStream = $this->getMeasurementsStreamFromDay($day);
                    $events = $dayStream->getEvents();
                    foreach ($events as $event) {
                        array_push($results, [
                            'patient' => $patient->getFirstname() . ' ' . $patient->getLastname(),
                            'date' => $day->getDate(),
                            'time' => $event->getTime(),
                            'measurement' => $event->getMeasurement(),
                            'measurementvalue' => $event->getMeasurementvalue(),
                        ]);
                    }
                }
            }
        }
        $results = $this->sortResults($results);
        return $results;
    }
    
    protected function sortResults($results) {
        usort($results, function ($a, $b) {
            $adate = $a['date'] . ' ' . $a['time'];
            $bdate = $b['date'] . ' ' . $b['time'];
            $astrtime = strtotime($adate);
            $bstrtime = strtotime($bdate);
            return $astrtime > $bstrtime ? -1 : 1;
        });        
        return $results;
    }
    
    protected function isDateNoOlderThan10Days($date) {
        $now = time();
        $dayDate = strtotime($date);
        echo $dayDate;
        return $now - $dayDate < 60*60*24*10;
    }

    protected function getMeasurementsStreamFromDay(Day $day) {
        $streams = $day->getStreams();
        $measurementsStream = null;
        foreach ($streams as $stream) {
            if($stream->getActivity() == 'measurements') {
                $measurementsStream = $stream;
                break;
            }
        }
        return $measurementsStream;
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
    
}
