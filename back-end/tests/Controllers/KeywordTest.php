<?php

/**
 * Class KeywordTest
 */
class KeywordTest extends TestCase
{
    /**
     *
     */
    public function testList()
    {
        $this->get('api/keywords' , $this->defaultHeaders())
            ->receiveJson()
            ->assertResponseOk();
    }

    public function testGetDetails()
    {
        $this->get('api/keywords/10' , $this->defaultHeaders())
            ->receiveJson()
            ->assertResponseOk();
    }

    public function testUpload()
    {
        $name = 'keywords.csv';
        $this->defaultHeaders();
        $file = \Illuminate\Http\UploadedFile::fake()->create($name, 0.164);
        $servers = [
            'HTTP_AUTHORIZATION' => 'Bearer ' .  $this->token
        ];

        $response = $this->call('POST', 'api/keywords/file-upload', [], [], ['File' => $file], $servers);
        $content = (string)$response->content();
        $data = json_decode($content);

        $this->assertResponseOk();
        $this->assertEquals(true, $data->success);
    }
}
