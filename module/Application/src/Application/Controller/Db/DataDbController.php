<?php

namespace Application\Controller\Db;

class DataDbController extends DbController
{
    
    public function indexAction() {
        try {
            $date = date('d/m/Y');
            
            /* institutions */
            $institutionModel = $this->model()->institutionModel();
            $patientModel = $this->model()->patientModel();
            $krakow = $institutionModel->add(['name' => 'Szpital wojewódzki w Krakowie']);
            $tarnow = $institutionModel->add(['name' => 'Centrum medyczne w Tarnowie']);
            $kk = $institutionModel->add(['name' => 'Placówka medyczna w Kędzierzynie-Koźlu']);

            $userModel = $this->model()->userModel();

            /* admin */
            $admin = $userModel->add([
                'login' => 'admin', 'password' => 'admin', 'group' => 'admin',
                'firstname' => 'Admin', 'lastname' => 'Admin', 'email' => 'admin@admin.pl'
            ]);
            
            /* doctors */
            $doc1 = $userModel->add([
                'login' => 'doktor1', 'password' => '12341234', 'group' => 'doctor',
                'firstname' => 'Krzysztof', 'lastname' => 'Krawczyk', 'email' => 'krawczyk@o2.pl',
                'institution' => $krakow->getId(),
            ]);
            $doc2 = $userModel->add([
                'login' => 'doktor2', 'password' => '12341234', 'group' => 'doctor',
                'firstname' => 'Janina', 'lastname' => 'Kozłowska', 'email' => 'kozlowska@buziaczek.pl',
                'institution' => $krakow->getId(),
            ]);
            $doc3 = $userModel->add([
                'login' => 'doktor3', 'password' => '12341234', 'group' => 'doctor',
                'firstname' => 'Barbara', 'lastname' => 'Nowakowska', 'email' => 'nowakowaska@gmail.com',
                'institution' => $tarnow->getId(),
            ]);
            $doc4 = $userModel->add([
                'login' => 'doktor4', 'password' => '12341234', 'group' => 'doctor',
                'firstname' => 'Ryszard', 'lastname' => 'Ronkowski', 'email' => 'ronkowski@buziaczek.pl',
                'institution' => $tarnow->getId(),
            ]);
            $doc5 = $userModel->add([
                'login' => 'doktor5', 'password' => '12341234', 'group' => 'doctor',
                'firstname' => 'Michał', 'lastname' => 'Czereśniak', 'email' => 'czeresniak@gmail.com',
                'institution' => $kk->getId(),
            ]);
            $doc6 = $userModel->add([
                'login' => 'doktor6', 'password' => '12341234', 'group' => 'doctor',
                'firstname' => 'Stanisław', 'lastname' => 'Barszcz', 'email' => 'barszcz@uszka.pl',
                'institution' => $kk->getId(),
            ]);

            /* patients */
            $pat1 = $userModel->add([
                'login' => 'patient1', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Albert', 'lastname' => 'Szklanka', 'email' => 'szklanka@o2.pl',
                'institution' => $krakow->getId(), 'doctor' => $doc1->getId(),
            ]);
            $ev11 = $patientModel->addEvent([
                'patientid' => $pat1->getId(), 'date' => $date, 'activity' => 'diet',
                'title' => 'Eat stuff', 'details' => '1 bowl of stuff', 'time' => '10:00', 
                'duration' => 30,
            ]);
            $ev12 = $patientModel->addEvent([
                'patientid' => $pat1->getId(), 'date' => $date, 'activity' => 'diet',
                'title' => 'Eat even more stuff', 'details' => '3 bowls of stuff', 'time' => '17:00', 
                'duration' => 60,
            ]);
            $ev13 = $patientModel->addEvent([
                'patientid' => $pat1->getId(), 'date' => $date, 'activity' => 'diet',
                'title' => 'Eat grapes', 'details' => '5 grapes', 'time' => '18:15', 
                'duration' => 15,
            ]);
            $ev21 = $patientModel->addEvent([
                'patientid' => $pat1->getId(), 'date' => $date, 'activity' => 'medicines',
                'title' => 'take drugs', 'details' => 'Medicinal drugs', 'time' => '12:00', 
                'duration' => 15,
            ]);
            $ev22 = $patientModel->addEvent([
                'patientid' => $pat1->getId(), 'date' => $date, 'activity' => 'medicines',
                'title' => 'take drugs', 'details' => '2x Rutinoscorbin', 'time' => '16:00', 
                'duration' => 15,
            ]);
            $ev23 = $patientModel->addEvent([
                'patientid' => $pat1->getId(), 'date' => $date, 'activity' => 'medicines',
                'title' => 'take drugs', 'details' => 'APAP night', 'time' => '22:00', 
                'duration' => 15,
            ]);
            $ev31 = $patientModel->addEvent([
                'patientid' => $pat1->getId(), 'date' => $date, 'activity' => 'exercises',
                'title' => 'Do stuff', 'details' => 'Run for 30 minutes', 'time' => '8:00', 
                'duration' => 30,
            ]);
            $ev32 = $patientModel->addEvent([
                'patientid' => $pat1->getId(), 'date' => $date, 'activity' => 'exercises',
                'title' => 'Do stuff', 'details' => 'Do a warm-up', 'time' => '14:00', 
                'duration' => 15,
            ]);
            $ev33 = $patientModel->addEvent([
                'patientid' => $pat1->getId(), 'date' => $date, 'activity' => 'exercises',
                'title' => 'Do stuff', 'details' => '20 push-ups', 'time' => '18:00', 
                'duration' => 15,
            ]);
            
            
            $pat2 = $userModel->add([
                'login' => 'patient2', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Piotr', 'lastname' => 'Głośnik', 'email' => 'glosnik@o2.pl',
                'institution' => $krakow->getId(), 'doctor' => $doc1->getId(),
            ]);
            $pat3 = $userModel->add([
                'login' => 'patient3', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Wiesław', 'lastname' => 'Zeszyt', 'email' => 'zeszyt@o2.pl',
                'institution' => $krakow->getId(), 'doctor' => $doc1->getId(),
            ]);
            $pat4 = $userModel->add([
                'login' => 'patient4', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Marcin', 'lastname' => 'Monitor', 'email' => 'monitor@o2.pl',
                'institution' => $krakow->getId(), 'doctor' => $doc2->getId(),
            ]);
            $pat5 = $userModel->add([
                'login' => 'patient5', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Mieczysław', 'lastname' => 'Biurko', 'email' => 'biurko@o2.pl',
                'institution' => $tarnow->getId(), 'doctor' => $doc3->getId(),
            ]);
            $pat6 = $userModel->add([
                'login' => 'patient6', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Klaudiusz', 'lastname' => 'Ściana', 'email' => 'sciana@o2.pl',
                'institution' => $tarnow->getId(),  'doctor' => $doc3->getId(),
            ]);
            $pat7 = $userModel->add([
                'login' => 'patient7', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Robert', 'lastname' => 'Wrona', 'email' => 'wrona@o2.pl',
                'institution' => $tarnow->getId(), 'doctor' => $doc4->getId(),
            ]);
            $pat8 = $userModel->add([
                'login' => 'patient8', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Jadwiga', 'lastname' => 'Kosiarka', 'email' => 'kosiarka@o2.pl',
                'institution' => $kk->getId(), 'doctor' => $doc5->getId(),
            ]);
            $pat9 = $userModel->add([
                'login' => 'patient9', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Antonina', 'lastname' => 'Chleb', 'email' => 'chleb@o2.pl',
                'institution' => $kk->getId(), 'doctor' => $doc5->getId(),
            ]);
            $pat10 = $userModel->add([
                'login' => 'patient10', 'password' => '12341234', 'group' => 'patient',
                'firstname' => 'Bronisław', 'lastname' => 'Łyżeczka', 'email' => 'lyzeczka@o2.pl',
                'institution' => $kk->getId(), 'doctor' => $doc6->getId(),
            ]);
            $json = $this->generateDataJSONViewModel([], 'Database populated with generated data!');
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
    public function clearAction() {
        try {
            $this->model()->doctorModel()->clear();
            $this->model()->patientModel()->clear();
            $this->model()->userModel()->clear();
            $this->model()->institutionModel()->clear();
            $this->model()->eventModel()->clear();
            $this->model()->dayModel()->clear();
            $this->model()->scheduleModel()->clear();
            $this->model()->streamModel()->clear();
            $json = $this->generateDataJSONViewModel([], 'Database cleared!');
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }

}

