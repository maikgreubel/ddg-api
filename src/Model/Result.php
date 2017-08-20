<?php
namespace Nkey\DDG\API\Model;

/**
 * Model for RelatedTopics property
 * 
 * @author Maik Greubel <greubel@nkey.de>
 */
class Result
{

    /**
     *
     * @var string
     */
    private $result;

    /**
     *
     * @var Icon
     */
    private $icon;

    /**
     *
     * @var string
     */
    private $firstURL;

    /**
     *
     * @var string
     */
    private $text;

    /**
     *
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     *
     * @param string $result
     * @return Result
     */
    public function setResult(string $result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     *
     * @return Icon
     */
    public function getIcon(): Icon
    {
        return $this->icon;
    }

    /**
     *
     * @param Icon $icon
     * @return Result
     */
    public function setIcon(Icon $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getFirstURL(): string
    {
        return $this->firstURL;
    }

    /**
     *
     * @param string $firstURL
     * @return Result
     */
    public function setFirstURL(string $firstURL)
    {
        $this->firstURL = $firstURL;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     *
     * @param string $text
     * @return Result
     */
    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }
}