<?php

class CrawlerJobTest extends TestCase
{
    public function testTotalLinks()
    {
        $items = [
            [
                "link" => "http://www-inst.eecs.berkeley.edu/~ee43/appendices/appendix4.PDF",
                "pagemap" => [
                    'cse_thumbnail' => [
                        [
                            "src" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7h30WlH-6FKh8ESWBD3cCyTRVPvQHd3HlMtLzGAlT6ESR-XP0CzcVdGA"
                        ]
                    ]
                ]
            ],
            [
                "link" => "http://www-inst.eecs.berkeley.edu/~ee43/appendices/appendix4.PDF",
                'formattedUrl' => "https://www.cs.dartmouth.edu/~lorenzo/teaching/cs183/.../tim.tregubov.pdf",
                'htmlFormattedUrl' => "https://www.cs.dartmouth.edu/~lorenzo/teaching/cs183/.../tim.tregubov.pdf",
                "pagemap" => [
                    'cse_thumbnail' => [
                        [
                            "src" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2k4CLdUlbaQVyKr9Q20-LobTG5h4Y9Ogw669oM99PzjfYZV4gVnpoIgL"
                        ]
                    ]
                ]
            ]
        ];

        $job = new \App\Jobs\CrawlerJob(null, null);
        $total = $job->totalLinks($items);

        $this->assertEquals(6, $total);
    }

    public function testHandle()
    {

        /** @var \App\Services\KeywordService $service */
        $service = app('KeywordService');
        $keyword = 'test keyword';
        $data = $service->store($keyword);

        $job = new \App\Jobs\CrawlerJob(\App\Entities\Keyword::class, $data->id);
        $entity = $job->handle(new \App\Services\BaseService());

        $this->assertNotEmpty($entity);
    }

    public function testHandleNULL()
    {
        $job = new \App\Jobs\CrawlerJob(\App\Entities\Keyword::class, -1);
        $entity = $job->handle(new \App\Services\BaseService());

        $this->assertEmpty($entity);
    }

    public function testGetHtml()
    {
        $keyword = 'lego';

        $job = new \App\Jobs\CrawlerJob(null, null);
        $html = $job->getHtml($keyword);
        $this->assertNotEmpty($html);
    }
}
