<?php

/**
 * Class UserServiceTest
 */
class UserServiceTest extends TestCase
{
    /**
     *
     */
    public function testGetUserByUserName()
    {
        /** @var \App\Services\UserService $service */
        $service = app('UserService');
        $user = $service->getUserByUserName('a@a.se');

        $this->assertEquals($user->username, 'a@a.se');
        $this->assertNotEmpty($user->id);
    }

    public function testUserNameNotFound()
    {
        $this->expectException(\App\Exceptions\NotFoundException::class);

        /** @var \App\Services\UserService $service */
        $service = app('UserService');
        $service->getUserByUserName('anonymous');
    }

    public function testRegister()
    {
        $faker = Faker\Factory::create();
        $name = $faker->name;
        $email = $faker->email;

        /** @var \App\Services\UserService $service */
        $service = app('UserService');
        $data = [
            "name" => $name,
            "email" => $email,
            "password" => '123123'
        ];

        $user = $service->register($data);
        $this->assertNotEmpty($user->id);
        $this->assertSame($user->fullName, $name);
        $this->assertSame($user->email, $email);
    }

    public function testExistUserException()
    {
        $this->expectException(\App\Exceptions\ClientException::class);
        $data = [
            "name" => 'unit test',
            "email" => 'a@a.se',
            "password" => '123123'
        ];

        /** @var \App\Services\UserService $service */
        $service = app('UserService');
        $service->register($data);
    }
}
