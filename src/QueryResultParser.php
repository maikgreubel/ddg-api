<?php
namespace Nkey\DDG\API;

use Nkey\DDG\API\Model\Icon;
use Nkey\DDG\API\Model\QueryResult;
use Nkey\DDG\API\Model\RelatedTopic;
use Webmozart\Json\JsonDecoder;
use ReflectionClass;
use ReflectionMethod;

/**
 * This class provides means for parsing json from duckduckgo api into a local model
 *
 * @author Maik Greubel <greubel@nkey.de>
 * @license Apache 2.0
 */
class QueryResultParser
{

    /**
     * Parse a payload json string
     *
     * @param string $payload
     *            The payload to parse
     * @return QueryResult
     */
    public function parseQueryResult(string $payload): QueryResult
    {
        $decoder = new JsonDecoder();
        
        $json = $decoder->decode($payload);
        
        $result = new QueryResult();
        
        $ref = new ReflectionClass($result);
        $methods = $ref->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method) {
            if (($propertyName = $this->getPropertyName($method))) {
                if ($propertyName === 'Meta') {
                    $result = $this->parseMeta($result, $json->meta);
                    continue;
                }
                $this->assignPropertyValue($method, $result, $json, $propertyName);
            }
        }
        
        $result = $this->parseRelatedTopics($result, $json->RelatedTopics);
        return $result;
    }
    
    private function assignPropertyValue(ReflectionMethod $method, $destObject, $object, $propertyName) {
        if (property_exists($object, $propertyName)) {
            $property = $object->$propertyName;
            $method->invoke($destObject, $property);
        }
    }
    
    private function getPropertyName(ReflectionMethod $method) {
        $propertyName = false;
        if (substr($method->name, 0, 3) === 'set') {
            $propertyName = substr($method->name, 3);
        }
        
        return $propertyName;
    }

    private function parseRelatedTopics(QueryResult $result, $relatedTopics)
    {
        foreach ($relatedTopics as $relatedTopic) {
            $topic = new RelatedTopic();
            $ref = new ReflectionClass($topic);
            $methods = $ref->getMethods(ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                if (($propertyName = $this->getPropertyName($method))) {
                    if ($propertyName === 'Icon') {
                        $topic = $this->parseIcon($topic, $relatedTopic->Icon);
                        continue;
                    }
                    $this->assignPropertyValue($method, $topic, $relatedTopic, $propertyName);
                }
            }
            $result->addRelatedTopic($topic);
        }
        
        return $result;
    }

    private function parseIcon(RelatedTopic $topic, $icon): RelatedTopic
    {
        $ico = new Icon();
        
        $ref = new ReflectionClass($ico);
        $methods = $ref->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method) {
            if (($propertyName = $this->getPropertyName($method))) {
                if (property_exists($icon, $propertyName)) {
                    $property = $icon->$propertyName;
                    
                    if ($propertyName === 'Height' || $propertyName === 'Width') {
                        $property = intval($property);
                    }
                    $method->invoke($ico, $property);
                }
            }
        }
        
        $topic->setIcon($ico);
        
        return $topic;
    }

    private function parseMeta(QueryResult $result, $meta): QueryResult
    {
        return $result;
    }
}