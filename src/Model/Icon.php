<?php
namespace Nkey\DDG\API\Model;

/**
 * Model for Icon property of related topics
 *
 * @author Maik Greubel <greubel@nkey.de>
 */
class Icon
{

    /**
     *
     * @var string
     */
    private $url = "";

    /**
     *
     * @var int
     */
    private $height = 0;

    /**
     *
     * @var int
     */
    private $width = 0;

    /**
     *
     * @return string
     */
    public function getURL(): string
    {
        return $this->url;
    }

    /**
     *
     * @param string $url
     * @return Icon
     */
    public function setURL(string $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     *
     * @param number $height
     * @return Icon
     */
    public function setHeight(int $height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     *
     * @return number
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     *
     * @param number $width
     * @return Icon
     */
    public function setWidth(int $width)
    {
        $this->width = $width;
        return $this;
    }
}