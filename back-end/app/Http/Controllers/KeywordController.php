<?php


namespace App\Http\Controllers;

use App\Exceptions\InvalidArgumentException;
use App\Services\KeywordService;
use Illuminate\Http\Request;

/**
 * Class KeywordController
 * @package App\Http\Controllers
 */
class KeywordController extends Controller
{
    /**
     * @var KeywordService
     */
    private $service;

    /**
     * KeywordController constructor.
     */
    public function __construct()
    {
        $this->service = app('KeywordService');
    }

    /**
     * @param Request $request
     * @return bool[]
     * @throws InvalidArgumentException
     */
    public function upload(Request $request)
    {
        if (!$request->hasFile('File')) {
            throw new InvalidArgumentException('File not found');
        }

        $file = $request->file('File');
        $ext = $file->getClientOriginalExtension();

        if ($ext !== 'csv') {
            throw new InvalidArgumentException('File invalid format');
        }

        $this->service->upload($file);

        return ['success' => true];
    }

    /**
     * @param Request $request
     * @return \App\Common\Response\ApiResponse
     */
    public function search(Request $request)
    {
        $params = $request->all();
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;

        return $this->response($this->service->search($params, $page, $limit));
    }

    /**
     * @param $id
     * @return \App\Common\Response\ApiResponse
     * @throws \App\Exceptions\NotFoundException
     */
    public function show($id)
    {
        return $this->response($this->service->show($id));
    }
}
