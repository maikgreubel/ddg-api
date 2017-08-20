<?php
namespace Nkey\DDG\API\Tests;

use Nkey\DDG\API\JsonProvider;
use PHPUnit\Framework\TestCase;
use Generics\Streams\FileInputStream;
use Nkey\DDG\API\QueryResultParser;
use Generics\Logger\ConsoleLogger;

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
        $this->provider->setLogger(new ConsoleLogger());
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
        
        $this->assertEquals("", $result->getAbstract());
        $this->assertEquals("Wikipedia", $result->getAbstractSource());
        $this->assertEquals("", $result->getAbstractText());
        $this->assertEquals("https://en.wikipedia.org/wiki/The_Simpsons_characters", $result->getAbstractURL());
        $this->assertEquals("", $result->getAnswer());
        $this->assertEquals("", $result->getAnswerType());
        $this->assertEquals("", $result->getDefinition());
        $this->assertEquals("", $result->getDefinitionSource());
        $this->assertEquals("", $result->getDefinitionURL());
        $this->assertEquals("", $result->getEntity());
        $this->assertEquals("The Simpsons characters", $result->getHeading());
        $this->assertEquals("", $result->getImage());
        $this->assertEquals(0, $result->getImageHeight());
        $this->assertFalse($result->isImageIsLogo());
        $this->assertEquals(0, $result->getImageWidth());
        $this->assertEquals("", $result->getInfobox());
        $this->assertNotNull($result->getMeta());
        $this->assertEquals("", $result->getRedirect());
        $this->assertCount(42, $result->getRelatedTopics());
        $this->assertCount(0, $result->getResults());
        $this->assertEquals("C", $result->getType());
    }
    
    /**
     * @test
     */
    public function testQueryForResults()
    {
        $payload = $this->provider->query("valley forge national park");
        
        $parser = new QueryResultParser();
        $result = $parser->parseQueryResult($payload);
        
        $this->assertCount(1, $result->getResults());
    }
}
