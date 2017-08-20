<?php
namespace Nkey\DDG\API;

use Nkey\DDG\API\Model\Icon;
use Nkey\DDG\API\Model\QueryResult;
use Nkey\DDG\API\Model\Result;
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
        
        $result = $this->parseResults($result, $json->RelatedTopics, false);
        $result = $this->parseResults($result, $json->Results, true);
        
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

    private function parseResults(QueryResult $queryResult, $results, bool $isResult)
    {
        foreach ($results as $result) {
            $res = new Result();
            $ref = new ReflectionClass($res);
            $methods = $ref->getMethods(ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                if (($propertyName = $this->getPropertyName($method))) {
                    if ($propertyName === 'Icon') {
                        $res = $this->parseIcon($res, $result->Icon);
                        continue;
                    }
                    $this->assignPropertyValue($method, $res, $result, $propertyName);
                }
            }
            if( $isResult ) {
                $queryResult->addResult($res);
            }
            else {
                $queryResult->addRelatedTopic($res);
            }
        }
        
        return $queryResult;
    }

    private function parseIcon(Result $result, $icon): Result
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
        
        $result->setIcon($ico);
        
        return $result;
    }

    private function parseMeta(QueryResult $result, $meta): QueryResult
    {
        return $result;
    }
}