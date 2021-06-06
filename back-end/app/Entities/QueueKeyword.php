<?php


namespace App\Entities;
/**
 * Class QueueKeyWord
 * @package App\Entities
 * @Doctrine\ORM\Mapping\Entity(repositoryClass="")
 * @Doctrine\ORM\Mapping\Table(name="`queue_keyword`")
 * @Doctrine\ORM\Mapping\HasLifecycleCallbacks
 */
class QueueKeyword extends BaseEntity
{
    /**
     * @Doctrine\ORM\Mapping\Id
     * @Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
     * @Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $id;

    /**
     * @Doctrine\ORM\Mapping\ManyToOne(targetEntity="Keyword", inversedBy="Queue")
     **/
    protected $keyword;
}
