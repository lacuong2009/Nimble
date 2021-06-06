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
     * @OA\Post(
     *     path="/api/keywords/file-upload",
     *     tags={"Keywords"},
     *     description="Upload file",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      property="File",
     *                      type="sting",
     *                      format="binary"
     *                  )
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
     *                  )
     *          )
     *     )
     * )
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
     *  @OA\Get(
     *     path="/api/keywords",
     *     description="Get keywords list",
     *     tags={"Keywords"},
     *     @OA\Parameter(
     *          name="page",
     *          in="query"
     *     ),
     *     @OA\Parameter(
     *          name="limit",
     *          in="query"
     *     ),
     *     @OA\Parameter(
     *          name="keyword",
     *          in="query",
     *          required=false
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Keyword",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="data",
     *                          type="array",
     *                          @OA\Items(ref="#/components/schemas/Keyword")
     *                      ),
     *                      @OA\Property(
     *                          property="total",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="page",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="limit",
     *                          type="integer"
     *                      ),
     *                  )
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
     * @OA\Get(
     *     path="/api/keywords/{id}",
     *     description="Get keyword",
     *     tags={"Keywords"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Keyword",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Keyword"
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
     * @param $id
     * @return \App\Common\Response\ApiResponse
     * @throws \App\Exceptions\NotFoundException
     */
    public function show($id)
    {
        return $this->response($this->service->show($id));
    }
}
