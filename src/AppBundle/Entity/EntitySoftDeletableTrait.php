<?php

namespace AppBundle\Entity;

use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;
use Doctrine\ORM\Mapping as ORM;

trait EntitySoftDeletableTrait
{
    /**
     * @var \DateTime|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @return \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function isDeleted(): bool
    {
        return isset($this->deletedAt);
    }

    /**
     * @Algolia\IndexIf
     */
    public function isNotDeleted(): bool
    {
        return !$this->isDeleted();
    }
}
