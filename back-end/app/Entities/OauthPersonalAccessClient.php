<?php


namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OauthPersonalAccessClient
 * @package App\Entities
 *
 * @ORM\Entity
 * @ORM\Table(name="oauth_personal_access_clients")
 */
class OauthPersonalAccessClient extends BaseEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(name="client_id", type="integer")
     */
    protected $clientId;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;
}
