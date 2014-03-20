<?php

namespace Application\Controller;
use Application\Model\DoctorModel;
use Application\Model\InstitutionModel;

class DbController extends BaseController {
    
    protected function doctorModel() {
        return new DoctorModel($this->mandango());
    }
    
    protected function institutionModel() {
        return new InstitutionModel($this->mandango());
    }

    protected function mandango() {
        return $this->getServiceLocator()->get('mandango');
    }

}
