<?php
namespace Nkey\DDG\API\Tests;

use Nkey\DDG\API\JsonProvider;
use PHPUnit\Framework\TestCase;
use Generics\Streams\FileInputStream;
use Nkey\DDG\API\QueryResultParser;

/**
 * This class provides means for testing the whole fetching and parsing functionality
 * 
 * @author Maik Greubel <greubel@nkey.de>
 */
class JsonProviderTest extends TestCase
{
    /**
     * The duck duck go json provider
     * @var JsonProvider
     */
    private $provider;
    
    protected function setUp()
    {
        $this->provider = new JsonProvider();
    }
    
    /**
     * @test
     */
    public function testSimpleQuery()
    {
        $payload = $this->provider->query("simpsons characters");
        $this->assertJson($payload);
    }
    
    /**
     * @test
     */
    public function testParse()
    {
        $f = new FileInputStream(dirname(__FILE__) . "/test-data.json");
        $payload = $f->read(51200);
        
        $parser = new QueryResultParser();
        $result = $parser->parseQueryResult($payload);
        
        $this->assertCount(42, $result->getRelatedTopics());
    }
    
    /**
     * @test
     */
    public function testQueryAndParse()
    {
        $payload = $this->provider->query("simpsons characters");
        
        $parser = new QueryResultParser();
        $result = $parser->parseQueryResult($payload);
        
        $this->assertCount(42, $result->getRelatedTopics());
    }
}
