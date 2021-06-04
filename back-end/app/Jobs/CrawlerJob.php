<?php

namespace App\Jobs;

use App\Entities\Keyword;
use App\Http\Clients\GoogleSearchClient;
use App\Services\BaseService;

/**
 * Class CrawlerJob
 * @package App\Jobs
 */
class CrawlerJob extends Job
{
    /** @var string */
    private $entityId;

    /** @var string */
    private $entityName;

    /**
     * CrawlerJob constructor.
     * @param $entityName
     * @param $entityId
     */
    public function __construct($entityName, $entityId)
    {
        $this->entityName = $entityName;
        $this->entityId = $entityId;
    }

    /**
     * @param BaseService $service
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(BaseService $service) : void
    {
        /** @var Keyword $entity */
        $entity = $service->getRepository($this->entityName)->find($this->entityId);

        if (!empty($entity)) {
            $this->editKeyword($entity);
        }

        $service->getEntityManager()->flush();
    }

    /**
     * @param Keyword $entity
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function editKeyword(Keyword $entity)
    {
        $google = 'https://www.google.com/search?q=' . $entity->keyword;
        $results = $this->getResults($entity->keyword);
        $summary = $results->searchInformation;

        $entity->totalAdWords = !empty($results->ads)? count($results->ads) : 0;
        $entity->totalLinks = $this->totalLinks($results->items);
        $entity->totalResults = $summary->totalResults;
        $entity->totalResultSeconds = $summary->formattedSearchTime;
        $entity->html = utf8_encode(file_get_contents($google)) ;
    }

    /**
     * @param $items
     * @return int
     */
    private function totalLinks($items)
    {
        $total = 0;
        foreach ($items as $item) {
            $this->countLinks($item, $total);
        }

        return $total;
    }

    /**
     * @param $item
     * @param $total
     * @return int
     */
    private function countLinks($item, &$total)
    {
        foreach ($item as $key => $value) {

            if (is_string($value) && $this->isUrl($value)) {
                $total++;
            }

            if (is_object($value)) {
                $this->countLinks($value, $total);
            }
        }

        return $total;
    }

    /**
     * @param $string
     * @return bool
     */
    private function isUrl($string)
    {
        $data = parse_url($string);
        return !empty($data['scheme']) && ($data['scheme'] === 'http' || $data['scheme'] === 'https');
    }

    /**
     * @param $keyword
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getResults($keyword)
    {
        $client = new GoogleSearchClient();
        $json = $client->search($keyword);

        return $json;
    }
}
