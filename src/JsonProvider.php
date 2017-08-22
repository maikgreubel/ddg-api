<?php
namespace Nkey\DDG\API;

use Generics\Client\HttpsClient;
use Generics\Socket\Url;
use Exception;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * This class provides means of fetching data from duckduckgo api
 *
 * @author Maik Greubel <greubel@nkey.de>
 * @license Apache 2.0
 */
class JsonProvider implements LoggerAwareInterface
{

    /**
     * Logger instance
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Timeout in seconds
     *
     * @var int
     */
    private $timeout = 5;

    /**
     *
     * @var HttpsClient
     */
    private $httpClient;

    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    /**
     * Set timeout in seconds
     *
     * @param int $timeout
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * Query the duck duck go api
     *
     * @param string $query
     *            Keywords to start a query for
     * @throws ApiException
     * @return string The payload
     */
    public function query(string $query): string
    {
        try {
            $this->createHttpClient($query);
            
            $response = "";
            $this->httpClient->request('GET');
            
            while ($this->httpClient->getPayload()->ready()) {
                $response .= $this->httpClient->getPayload()->read($this->httpClient->getPayload()
                    ->count());
            }
            
            $response = strstr($response, "{");
            $response = substr($response, 0, strrpos($response, "}") + 1);
            return $response;
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
            $this->logger->debug($ex->getTraceAsString());
            throw new ApiException("Could not retrieve query response: {cause}", array(
                'cause' => $ex->getMessage()
            ), $ex->getCode(), $ex);
        }
    }

    private function createHttpClient(string $query)
    {
        $this->httpClient = new HttpsClient($this->provideUrl($query));
        $this->httpClient->setTimeout($this->timeout);
        $this->httpClient->setHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36');
        $this->httpClient->setHeader('Accept-Encoding', 'identity'); // Currently there is a bug in HttpClient for passing buf to gzdecode()
        $this->httpClient->setHeader('Connection', 'close');
    }

    /**
     * Provide an URL object out of given duckduckgo query
     *
     * @param string $query
     * @return Url
     */
    private function provideUrl(string $query): Url
    {
        $url = new Url(sprintf("https://api.duckduckgo.com/?q=%s&format=json", urlencode($query)));
        
        return $url;
    }

    /**
     * Set the logger
     * 
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
