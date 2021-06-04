<?php


namespace App\Http\Controllers;

use App\Exceptions\InvalidArgumentException;
use App\Services\KeywordService;
use Illuminate\Http\Request;

/**
 * Class FileController
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    /**
     * @var KeywordService
     */
    private $service;

    /**
     * FileController constructor.
     */
    public function __construct()
    {
        $this->service = app('KeywordService');
    }

    /**
     * @param Request $request
     * @return bool
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

        return true;
    }
}
