<?php


namespace App\Entities;
/**
 * Class Keyword
 * @package App\Entities
 *
 * @Doctrine\ORM\Mapping\Entity(repositoryClass="\App\Repositories\KeywordRepository")
 * @Doctrine\ORM\Mapping\Table(name="`keyword`")
 * @Doctrine\ORM\Mapping\HasLifecycleCallbacks
 */
class Keyword extends BaseEntity
{
    /**
     * @Doctrine\ORM\Mapping\Id
     * @Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
     * @Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $id;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string", nullable=true)
     */
    protected $keyword;

    /**
     * @Doctrine\ORM\Mapping\Column(type="integer", nullable=true)
     */
    protected $totalAdWords;

    /**
     * @Doctrine\ORM\Mapping\Column(type="integer", nullable=true)
     */
    protected $totalLinks;

    /**
     * @Doctrine\ORM\Mapping\Column(type="integer", nullable=true)
     */
    protected $totalResults;

    /**
     * @Doctrine\ORM\Mapping\Column(type="float", nullable=true)
     */
    protected $totalResultSeconds;

    /**
     * @Doctrine\ORM\Mapping\Column(type="text", nullable=true)
     */
    protected $html;

    /**
     * @Doctrine\ORM\Mapping\OneToMany(targetEntity="QueueKeyword", mappedBy="Keyword", cascade={"remove"})
     **/
    protected $Queue;
}
