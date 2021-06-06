<?php


namespace App\Http\Controllers;

use App\Entities\User;
use App\Helpers\UserHelper;
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
     * @OA\Post(
     *     path="/oauth/register",
     *     tags={"User"},
     *     description="Register user",
     *     @OA\RequestBody(
     *          description="Input data format",
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/User"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="201",
     *          description="User",
     *          @OA\JsonContent(
     *                  type="object",
     *                  @OA\Property(
     *                      property="success",
     *                      type="boolean"
     *                  ),
     *                  @OA\Property(
     *                      property="data",
     *                      ref="#/components/schemas/User"
     *                  )
     *          )
     *     )
     * )
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
     * @OA\Get(
     *     path="/api/users/{username}",
     *     description="Get user",
     *     tags={"User"},
     *     @OA\Parameter(
     *          name="username",
     *          in="path",
     *          required=true,
     *          description="Username",
     *          @OA\Schema(
     *              type="string"
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="User",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/User"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *      security={
     *       {"bearer_token": {}}
     *     }
     * )
     *
     * @param $username
     * @return \App\Common\Response\ApiResponse
     */
    public function show($username)
    {
        return $this->response($this->service->show($username));
    }

    /**
     * @OA\Get(
     *     path="/api/users/me",
     *     description="Get user",
     *     tags={"User"},
     *     @OA\Response(
     *          response="200",
     *          description="User",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/User"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *      security={
     *       {"bearer_token": {}}
     *     }
     * )
     *
     * @param Request $request
     * @return \App\Common\Response\ApiResponse
     */
    public function me(Request $request)
    {
        $data = $request->user();

        return $this->response(UserHelper::makeModelUser($data));
    }
}
