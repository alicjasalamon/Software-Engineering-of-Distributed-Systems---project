<?php

namespace Application\Controller;

class DataController extends DbController
{
    
    public function indexAction() {
        try {
            /* institutions */
            $institutionModel = $this->institutionModel();
            $krakow = $institutionModel->add(['name' => 'Szpital wojewódzki w Krakowie']);
            $tarnow = $institutionModel->add(['name' => 'Centrum medyczne w Tarnowie']);
            $kk = $institutionModel->add(['name' => 'Placówka medyczna w Kędzierzynie-Koźlu']);

            $userModel = $this->userModel();

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
            
            $json = $this->generateJSONViewModel(0, 'Data generated!', []);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }
    
    public function clearAction() {
        try {
            $this->doctorModel()->clear();
            $this->patientModel()->clear();
            $this->userModel()->clear();
            $this->institutionModel()->clear();
            $json = $this->generateJSONViewModel(0, 'Database cleared!', []);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }

}

