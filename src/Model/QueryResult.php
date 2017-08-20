<?php
namespace Nkey\DDG\API\Model;

/**
 * Model for the result of an api query
 *
 * @author Maik Greubel <greubel@nkey.de>
 */
class QueryResult
{

    /**
     *
     * @var string
     */
    private $definitionSource;

    /**
     *
     * @var string
     */
    private $heading;

    /**
     *
     * @var int
     */
    private $imageWidth;

    /**
     *
     * @var array
     */
    private $relatedTopics;

    /**
     *
     * @var string
     */
    private $entity;

    /**
     *
     * @var Metadata
     */
    private $meta;

    /**
     *
     * @var string
     */
    private $type;

    /**
     *
     * @var string
     */
    private $redirect;

    /**
     *
     * @var string
     */
    private $definitionURL;

    /**
     *
     * @var string
     */
    private $abstractURL;

    /**
     *
     * @var string
     */
    private $definition;

    /**
     *
     * @var string
     */
    private $abstractSource;

    /**
     *
     * @var string
     */
    private $infobox;

    /**
     *
     * @var string
     */
    private $image;

    /**
     *
     * @var bool
     */
    private $imageIsLogo;

    /**
     *
     * @var string
     */
    private $abstract;

    /**
     *
     * @var string
     */
    private $abstractText;

    /**
     *
     * @var string
     */
    private $answerType;

    /**
     *
     * @var int
     */
    private $imageHeight;

    /**
     *
     * @var string
     */
    private $answer;

    /**
     *
     * @var array
     */
    private $results;

    /**
     *
     * @return string
     */
    public function getDefinitionSource(): string
    {
        return $this->definitionSource;
    }

    /**
     *
     * @param string $definitionSource
     * @return QueryResult
     */
    public function setDefinitionSource(string $definitionSource): QueryResult
    {
        $this->definitionSource = $definitionSource;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getHeading(): string
    {
        return $this->heading;
    }

    /**
     *
     * @param string $heading
     * @return QueryResult
     */
    public function setHeading(string $heading): QueryResult
    {
        $this->heading = $heading;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getImageWidth(): int
    {
        return $this->imageWidth;
    }

    /**
     *
     * @param int $imageWidth
     * @return QueryResult
     */
    public function setImageWidth(int $imageWidth): QueryResult
    {
        $this->imageWidth = $imageWidth;
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     *
     * @param string $entity
     * @return QueryResult
     */
    public function setEntity(string $entity): QueryResult
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     *
     * @return Metadata
     */
    public function getMeta(): Metadata
    {
        return $this->meta == null ? new Metadata() : $this->meta;
    }

    /**
     *
     * @param Metadata $meta
     * @return QueryResult
     */
    public function setMeta(Metadata $meta): QueryResult
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     *
     * @param string $type
     * @return QueryResult
     */
    public function setType(string $type): QueryResult
    {
        $this->type = $type;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getRedirect(): string
    {
        return $this->redirect;
    }

    /**
     *
     * @param string $redirect
     * @return QueryResult
     */
    public function setRedirect(string $redirect): QueryResult
    {
        $this->redirect = $redirect;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getDefinitionURL(): string
    {
        return $this->definitionURL;
    }

    /**
     *
     * @param string $definitionURL
     * @return QueryResult
     */
    public function setDefinitionURL(string $definitionURL): QueryResult
    {
        $this->definitionURL = $definitionURL;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAbstractURL(): string
    {
        return $this->abstractURL;
    }

    /**
     *
     * @param string $abstractURL
     * @return QueryResult
     */
    public function setAbstractURL(string $abstractURL): QueryResult
    {
        $this->abstractURL = $abstractURL;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getDefinition(): string
    {
        return $this->definition;
    }

    /**
     *
     * @param string $definition
     * @return QueryResult
     */
    public function setDefinition(string $definition): QueryResult
    {
        $this->definition = $definition;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAbstractSource(): string
    {
        return $this->abstractSource;
    }

    /**
     *
     * @param string $abstractSource
     * @return QueryResult
     */
    public function setAbstractSource(string $abstractSource): QueryResult
    {
        $this->abstractSource = $abstractSource;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getInfobox(): string
    {
        return $this->infobox;
    }

    /**
     *
     * @param string $infobox
     * @return QueryResult
     */
    public function setInfobox(string $infobox): QueryResult
    {
        $this->infobox = $infobox;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     *
     * @param string $image
     * @return QueryResult
     */
    public function setImage(string $image): QueryResult
    {
        $this->image = $image;
        return $this;
    }

    /**
     *
     * @return bool
     */
    public function isImageIsLogo(): bool
    {
        return $this->imageIsLogo;
    }

    /**
     *
     * @param bool $imageIsLogo
     * @return QueryResult
     */
    public function setImageIsLogo(bool $imageIsLogo): QueryResult
    {
        $this->imageIsLogo = $imageIsLogo;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAbstract(): string
    {
        return $this->abstract;
    }

    /**
     *
     * @param string $abstract
     * @return QueryResult
     */
    public function setAbstract(string $abstract): QueryResult
    {
        $this->abstract = $abstract;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAbstractText(): string
    {
        return $this->abstractText;
    }

    /**
     *
     * @param string $abstractText
     * @return QueryResult
     */
    public function setAbstractText(string $abstractText): QueryResult
    {
        $this->abstractText = $abstractText;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAnswerType(): string
    {
        return $this->answerType;
    }

    /**
     *
     * @param string $answerType
     * @return QueryResult
     */
    public function setAnswerType(string $answerType): QueryResult
    {
        $this->answerType = $answerType;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getImageHeight(): int
    {
        return $this->imageHeight;
    }

    /**
     *
     * @param int $imageHeight
     * @return QueryResult
     */
    public function setImageHeight(int $imageHeight): QueryResult
    {
        $this->imageHeight = $imageHeight;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     *
     * @param string $answer
     * @return QueryResult
     */
    public function setAnswer($answer): QueryResult
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     *
     * @return array
     */
    public function getRelatedTopics(): array
    {
        return $this->relatedTopics;
    }

    /**
     *
     * @return array
     */
    public function getResults(): array
    {
        return $this->results == null ? array() : $this->results;
    }

    /**
     *
     * @param Result $result
     * @return QueryResult
     */
    public function addResult(Result $result): QueryResult
    {
        $this->results[] = $result;
        return $this;
    }
    
    /**
     * 
     * @param Result $topic
     * @return QueryResult
     */
    public function addRelatedTopic(Result $topic): QueryResult
    {
        $this->relatedTopics[] = $topic;
        return $this;
    }
}