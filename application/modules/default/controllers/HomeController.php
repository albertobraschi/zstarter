<?php

class HomeController extends AuthControllerAction {

    public function indexAction() 
    {
        $this->_redirect("/");
    }

}
