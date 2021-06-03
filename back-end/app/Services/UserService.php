<?php

namespace App\Services;

use App\Entities\User;
use App\Exceptions\ClientException;
use App\Exceptions\NotFoundException;
use App\Helpers\UserHelper;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends BaseService
{
    /**
     * @param $params
     * @return UserModel
     * @throws ClientException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function register($params) : UserModel
    {
        $password = Hash::make($params['password']);
        $username = $params['email'];
        $user = $this->getRepository(User::class)->findOneBy(['username' => $username]);

        if (!empty($user)) {
            throw new ClientException('User already existed.');
        }

        $user = new User();
        $user->setPassword($password);
        $user->fullName = $params['name'];
        $user->email = $params['email'];
        $user->username = $username;
        $user->status = 1;

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);

        return UserHelper::makeModelUser($user);
    }

    /**
     * @param $username
     * @return User
     * @throws NotFoundException
     */
    public function getUserByUserName($username) : User
    {
        /** @var User $user */
        $user = $this->getRepository(User::class)->findOneBy(['username' => $username]);

        if (empty($user)) {
            throw new NotFoundException('User not found');
        }

        return $user;
    }

    /**
     * @param $username
     * @return \App\Models\User
     * @throws \Exception
     */
    public function show($username) : UserModel
    {
        return UserHelper::makeModelUser($this->getUserByUserName($username));
    }
}
