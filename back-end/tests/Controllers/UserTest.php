<?php

/**
 * Class UserTest
 */
class UserTest extends TestCase
{
    /**
     * UserTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * testRegisterUser
     */
    public function testRegisterUser()
    {
        $faker = Faker\Factory::create();

        $this->post('/oauth/register', [
            "name" => $faker->name,
            "email" => $faker->email,
            "password" => '123123'
        ])->assertResponseStatus(201);
    }

    /**
     * testRegisterUser
     */
    public function testAuthUser()
    {
        $this->post('/oauth/token', [
            "grant_type" => 'password',
            "client_id" =>env('CLIENT_ID'),
            "client_secret" => env('CLIENT_SECRET'),
            "username" => 'a@a.se',
            "password" => '123123'
        ])->receiveJson()->assertResponseOk();

        $content = (string) $this->response->getContent();
        $data = json_decode($content);

        $this->assertNotEmpty($data->access_token);
        $this->assertNotEmpty($data->refresh_token);
        $this->assertEquals($data->token_type, 'Bearer');
    }

    /**
     *
     */
    public function testGetUserInfo()
    {
        $this->get('api/users/me' , $this->defaultHeaders())
            ->receiveJson()
            ->assertResponseOk();

        $content = (string) $this->response->getContent();
        $data = json_decode($content);

        $this->assertEquals($data->success, true);
        $this->assertNotEmpty($data->data);
        $this->assertNotEmpty($data->data->id);
    }

    public function testGetUserByUsername()
    {
        $this->get('api/users/a@a.se' , $this->defaultHeaders())
            ->receiveJson()
            ->assertResponseOk();

        $content = (string) $this->response->getContent();
        $data = json_decode($content);

        $this->assertEquals($data->success, true);
        $this->assertNotEmpty($data->data);
        $this->assertNotEmpty($data->data->id);
    }
}
