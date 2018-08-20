<?php
namespace Andrew\Blog\Controllers;

use Andrew\Blog\Models\RequestModel;
use Andrew\Blog\Models\SessionModel;
use Andrew\Blog\Views\View;

class Controller {
    /** @var View */
    protected $view;
    /** @var SessionModel */
    protected $session;
    /** @var RequestModel */
    protected $request;

    public function __construct($view) {
        $this->view = $view;
        $this->session = new SessionModel();
        $this->request = new RequestModel();
    }

    public function redirect($act = null) {
        header("location: /index.php" . ($act == null ? "" : ("?act=" . $act)));
        die;
    }

    public function process($data = null) {
        $this->view->process($data);
    }
}