<?php

namespace Code\Http\Controllers;

use Illuminate\Http\Request;

use Code\Http\Requests;
use Code\Http\Controllers\Controller;

use Code\Repositories\UserRepository;

use \LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function authenticated(){
        $userId = Authorizer::getResourceOwnerId();
        return $this->userRepository->find($userId);
    }
    
}
