<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

abstract class BaseController extends AbstractActionController {
    
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
    
}
