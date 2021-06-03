<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase
 */
abstract class TestCase extends BaseTestCase
{
    /**
     * @var string
     */
    protected $token;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return string
     */
    public function getToken()
    {
        if (empty( $this->token)) {
            $this->post('/oauth/token', [
                "grant_type" => 'password',
                "client_id" =>env('CLIENT_ID'),
                "client_secret" => env('CLIENT_SECRET'),
                "username" => 'a@a.se',
                "password" => '123123'
            ]);

            $content = (string) $this->response->getContent();
            $data = json_decode($content);

            $this->token = $data->access_token;
        }

        return $this->token;
    }

    /**
     * @return string[]
     */
    protected function defaultHeaders()
    {
        $this->getToken();

        return [
            'Authorization' => 'Bearer ' .  $this->token
        ];
    }
}
