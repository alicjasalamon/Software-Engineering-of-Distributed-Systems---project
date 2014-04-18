<?php

namespace Application\Controller;

use Zend\View\Model\JsonModel;
use Application\Model\Model;

class DbController extends BaseController {
   
    /**
     * @var Model;
     */
    protected $model;
   
    protected function mandango() {
        return $this->getServiceLocator()->get('mandango');
    }
    
    /**
     * @var Model
     */
    protected function model() {
        if(!$this->model) {
            $this->model = new Model($this->mandango());
        }
        return $this->model;
    }
    
    protected function getParams() {
        $config = $this->getServiceLocator()->get('config');
        $paramsMethod = $config['params_method'];
        $params = null;
        if($paramsMethod == 'any'){
            $params = $this->params()->fromPost();
            if(count($params) <= 0) {
                $params = $this->params()->fromQuery();
            }
        } else if($paramsMethod == 'post'){
            $params = $this->params()->fromPost();
        } else if($paramsMethod == 'get') {
            $params = $this->params()->fromQuery();
        }
        return $params;
    }
    
    protected function generateJSONViewModel($code = -1, $message = "", $data = null) {
        $jsonModel = new JsonModel();
        $jsonModel->setVariable('code', $code);
        $jsonModel->setVariable('message', $message);
        $jsonModel->setVariable('data', $data);
        return $jsonModel;
    }
    
    protected function generateFailedJSONViewModel(Exception $ex) {
        return $this->generateJSONViewModel(1, $ex->getMessage());
    }    
    
    protected function generateInvalidParamsJSONViewModel(InvalidParameterException $ex) {
        return $this->generateJSONViewModel('101', $ex->toString());
    }
    
}
