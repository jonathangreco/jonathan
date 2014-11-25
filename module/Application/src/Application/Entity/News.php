<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class News
{
	/**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id_news;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    protected $content;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    protected $title;

    /**
     * Gets the value of id_news.
     *
     * @return mixed
     */
    public function getIdNews()
    {
        return $this->id_news;
    }

    /**
     * Sets the value of id_news.
     *
     * @param mixed $id_news the id news
     *
     * @return self
     */
    public function setIdNews($id_news)
    {
        $this->id_news = $id_news;

        return $this;
    }

    /**
     * Gets the value of content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the value of content.
     *
     * @param string $content the content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Gets the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the value of title.
     *
     * @param string $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
