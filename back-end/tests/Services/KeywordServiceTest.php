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

    public function testSearch()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $data = $service->search([], 1, 10);

        $this->assertNotEmpty($data);
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
        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');

        try {
            $data = $service->show(-1);
        } catch (\Exception $exception) {
            $this->assertSame('Not found Keyword', $exception->getMessage());
        }
    }
}
