<?php

namespace Application\Controller;
class UserController extends DbController {
    
    public function addAction() {
        $params = $this->getParams();
        try {
            $user = $this->userModel()->add($params);
            $userJson = $user ? $user->toArray(true) : [];
            $json = $this->generateJSONViewModel(0, '', $userJson);
        } catch (Exception $ex) {
            $json = $this->generateJSONViewModel(1, $ex->getMessage(), null);
        }
        return $json;
    }

}

