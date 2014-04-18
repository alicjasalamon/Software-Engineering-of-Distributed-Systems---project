<?php

namespace Application\Controller;

use Application\Controller\Validators\UserValidator;

class UserDbController extends DbController {
    
    /**
     * @var UserValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new UserValidator();
    }
    
    public function addAction() {
        $params = $this->getParams();
        try {
            $this->validator->validateAdd($params);
            $user = $this->model()->userModel()->add($params);
            $userJson = $user ? $user->toArray(true) : [];
            $json = $this->generateJSONViewModel(0, '', $userJson);
        } catch (InvalidParameterException $ex) {
            $json = $this->generateInvalidParamsJSONViewModel($ex);
        } catch (Exception $ex) {
            $json = $this->generateFailedJSONViewModel($ex);
        }
        return $json;
    }

}

