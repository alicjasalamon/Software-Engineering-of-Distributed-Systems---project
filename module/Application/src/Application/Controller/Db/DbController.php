<?php

namespace Application\Controller\Db;

use Zend\View\Model\JsonModel;
use Application\Controller\BaseController;
use Application\Model\Model;
use Application\Utilities\Exceptions\InvalidParameterException;

class DbController extends BaseController {
   
    /**
     * @var Model;
     */
    private $model;
   
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
    
    protected function wrapSingleResultAction($action) {
        return $this->wrapAction($action, function($value) {
            return $value 
                ? (is_array($value) 
                    ? $value
                    : $value->toArray(true))
                : [];
        });
    }
    
    protected function wrapMultipleResultsAction($action) {
        return $this->wrapAction($action, function($value) {
            $actionJson = [];
            foreach($value as $val) {
                $json = $val->toArray(true);
                array_push($actionJson, $json);
            }
            return $actionJson;
        });
    }
    
    protected function wrapAction($action, $serialize) {
        try {
            $params = $this->getParams();
            $returnValue = $action($params);
            $actionJson = $serialize($returnValue);
            $json = $this->generateDataJSONViewModel($actionJson);
        } catch (InvalidParameterException $ex) {
            $json = $this->generateInvalidParamsJSONViewModel($ex);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }
    
    protected function generateJSONViewModel($code = -1, $message = "", $data = null) {
        $jsonModel = new JsonModel();
        $jsonModel->setVariable('code', $code);
        $jsonModel->setVariable('message', $message);
        $jsonModel->setVariable('data', $data);
        return $jsonModel;
    }
    
    protected function generateDataJSONViewModel($json, $message = '') {
        return $this->generateJSONViewModel(0, $message, $json);
    }
    
    protected function generateFailedJSONViewModel(Exception $ex) {
        return $this->generateJSONViewModel(1, $ex->getMessage());
    }    
    
    protected function generateInvalidParamsJSONViewModel(InvalidParameterException $ex) {
        return $this->generateJSONViewModel('101', $ex->toString());
    }
    
    
}
