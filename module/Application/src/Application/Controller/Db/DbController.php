<?php

namespace Application\Controller\Db;

use Zend\View\Model\JsonModel;
use Application\Controller\BaseController;
use Application\Utilities\Exceptions\InvalidParameterException;

class DbController extends BaseController {
    
    public function indexAction() {
        //$this->requireAuth(['admin']);
        return parent::indexAction();
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
            $this->requireAuth();
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
