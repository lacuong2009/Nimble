<?php


namespace App\Http\Controllers;

use App\Entities\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->service = app('UserService');
    }

    /**
     * @param Request $request
     * @return \App\Common\Response\ApiResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function register(Request $request)
    {
        $params = $request->all();
        return $this->response($this->service->register($params));
    }

    /**
     * @param $username
     * @return \App\Common\Response\ApiResponse
     */
    public function show($username)
    {
        return $this->response($this->service->show($username));
    }
}
