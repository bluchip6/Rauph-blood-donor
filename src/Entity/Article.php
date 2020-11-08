<?php

namespace App\Entity;

use App\Core\Entity;
use App\Core\TimestampableEntity;
use App\Services\Slugifier;

class Article extends Entity
{
    use TimestampableEntity;

    private string $title;
    private string $slug;
    private string $content;
    private string $textHeader;
    private int $adminId;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;

        self::setSlug($title);
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $slugifier = new Slugifier();

        $this->slug = $slugifier->slugify($slug);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getTextHeader(): string
    {
        return $this->textHeader;
    }

    /**
     * @param string $textHeader
     */
    public function setTextHeader(string $textHeader): void
    {
        $this->textHeader = $textHeader;
    }

    /**
     * @return int
     */
    public function getAdminId(): int
    {
        return $this->adminId;
    }

    /**
     * @param int $adminId
     */
    public function setAdminId(int $adminId)
    {
        $this->adminId = $adminId;
    }
}
