<?php

namespace Abackdev\User\app\Http\Controllers;
use App\Http\Controllers\Controller;
use Abackdev\User\Message;
class UserController extends Controller{

    public function index(){
       Message::send(7997791346,'hey there');
    }
}