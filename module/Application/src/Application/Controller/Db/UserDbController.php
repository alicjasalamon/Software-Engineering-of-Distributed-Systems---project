<?php

namespace Application\Controller\Db;

use Application\Utilities\Validators\UserValidator;

class UserDbController extends DbController {
    
    /**
     * @var UserValidator
     */
    protected $validator;
    
    public function __construct() {
        $this->validator = new UserValidator();
    }
    
    public function addAction() {
        return $this->wrapSingleResultAction(function ($params) {
            $this->validator->validateAdd($params);
            $user = $this->model()->userModel()->add($params);
            return $user;
        });
    }

}

