<?php

/**
 * Class FileServiceTest
 */
class KeywordServiceTest extends TestCase
{
    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testGetNumberImportToday()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $data = $service->getNumberImportToday();

        $this->assertIsInt($data);
        $this->assertNotEmpty($data);
    }

    public function testIsFullQuota()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $data = $service->isFullQuota();

        $this->assertIsBool($data);
    }

    public function testSearchAll()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $data = $service->search([], 1, 10);

        $this->assertNotEmpty($data);
        $this->assertNotEmpty($data['items']);
        $this->assertNotEmpty($data['total']);
        $this->assertGreaterThan(0, count($data['items']));
    }

    public function testSearchKeyword()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $data = $service->search(['keyword' => 'lego'], 1, 10); // this keyword already existed in database

        $this->assertNotEmpty($data);
        $this->assertNotEmpty($data['items']);
        $this->assertNotEmpty($data['total']);
    }

    public function testSearchKeywordNotFound()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $data = $service->search(['keyword' => 'anonymous'], 1, 10);

        $this->assertNotEmpty($data);
        $this->assertEquals(0, $data['total']);
        $this->assertEquals(0, count($data['items']));
    }

    public function testShow()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $data = $service->show(5);

        $this->assertNotEmpty($data);
    }

    public function testShowNotFound()
    {
        $this->expectException(\App\Exceptions\NotFoundException::class);
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');

        try {
            $data = $service->show(-1);
        } catch (\Exception $exception) {
            $this->assertSame('Not found Keyword', $exception->getMessage());
            throw $exception;
        }
    }

    public function testStore()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $keyword = 'test keyword';
        $data = $service->store($keyword);
        $this->assertSame($keyword, $data->keyword);
    }

    public function testStoreDuplicated()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $keyword = 'lego'; // assume this keyword already existed in database
        $data = $service->store($keyword);
        $this->assertSame($keyword, $data->keyword);
        $this->assertLessThan(
            strtotime(\Carbon\Carbon::now()->toIso8601String()),
            strtotime(\Carbon\Carbon::parse($data->created)->toIso8601String())
        );
    }


}
