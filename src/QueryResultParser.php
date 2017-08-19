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
            assert($method instanceof ReflectionMethod);
            
            if (substr($method->getName(), 0, 3) === 'set') {
                $propertyName = substr($method->getName(), 3);
                if ($propertyName === 'Meta') {
                    $result = $this->parseMeta($result, $json->meta);
                    continue;
                }
                if (property_exists($json, $propertyName)) {
                    $property = $json->$propertyName;
                    $method->invoke($result, $property);
                }
            }
        }
        
        $result = $this->parseRelatedTopics($result, $json->RelatedTopics);
        return $result;
    }

    private function parseRelatedTopics(QueryResult $result, $relatedTopics)
    {
        foreach ($relatedTopics as $relatedTopic) {
            $topic = new RelatedTopic();
            $ref = new ReflectionClass($topic);
            $methods = $ref->getMethods(ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                assert($method instanceof ReflectionMethod);
                
                if (substr($method->getName(), 0, 3) === 'set') {
                    $propertyName = substr($method->getName(), 3);
                    
                    if ($propertyName === 'Icon') {
                        $topic = $this->parseIcon($topic, $relatedTopic->Icon);
                        continue;
                    }
                    
                    if (property_exists($relatedTopic, $propertyName)) {
                        $property = $relatedTopic->$propertyName;
                        $method->invoke($topic, $property);
                    }
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
            assert($method instanceof ReflectionMethod);
            
            if (substr($method->getName(), 0, 3) === 'set') {
                $propertyName = substr($method->getName(), 3);
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