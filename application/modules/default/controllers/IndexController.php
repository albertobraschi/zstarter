<?php

class IndexController extends AuthControllerAction {

    public function indexAction() 
    {
        if (!isset($this->_user)) {
            $this->_redirect("/auth/");
        }
    }

}
