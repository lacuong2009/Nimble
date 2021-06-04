<?php

/**
 * Class FileServiceTest
 */
class FileServiceTest extends TestCase
{
    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testGetNumberImportToday()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('FileService');
        $data = $service->getNumberImportToday();

        $this->assertIsInt($data);
        $this->assertNotEmpty($data);
    }

    public function testIsFullQuota()
    {
        /** @var \App\Services\KeywordService $service */
        $service = app('FileService');
        $data = $service->isFullQuota();

        $this->assertIsBool($data);
    }
}
