<?php

namespace App\Http\Controllers\Backend;

class HomeController extends BackendController
{
    public function __construct()
    {
        $this->setTitle(__('messages.page_title.backend.home'));
    }

    public function index()
    {
        return $this->render();
    }
}
