<?php

namespace App\Http\Clients;
use GuzzleHttp\Client;

/**
 * Class GoogleSearchClient
 * @package App\Http\Clients
 */
class GoogleSearchClient extends Client
{
    /**
     * @var string
     *
     */
    private $url = 'https://www.googleapis.com/customsearch/v1';

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $cx;

    /**
     * GoogleSearchClient constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->key = env('GOOGLE_API_KEY');
        $this->cx = env('GOOGLE_PARAMS_CX');
    }

    /**
     * @param $keyword
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search($keyword) : object
    {
        $body = $this->request('GET', $this->url, [
            'query' => [
                'q' => $keyword,
                'key' => $this->key,
                'cx' => $this->cx,
            ]
        ])->getBody();

        $content = $body->getContents();
        return json_decode($content);
    }
}
