<?php
namespace Nkey\DDG\API;

use Generics\Client\HttpClient;
use Generics\Socket\Url;

/**
 * This class provides means of fetching data from duckduckgo api
 *
 * @author Maik Greubel <greubel@nkey.de>
 * @license Apache 2.0
 */
class JsonProvider
{

    /**
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Query the duck duck go api
     *
     * @param string $query
     *            Keywords to start a query for
     * @return string The payload
     */
    public function query(string $query): string
    {
        $this->httpClient = new HttpClient($this->provideUrl($query));
        $this->httpClient->setHeader('User-Agent', '*');
        $this->httpClient->setHeader('Accept-Encoding', 'identity'); // Currently there is a bug in HttpClient for passing buf to gzdecode()
        $this->httpClient->request('GET');
        $response = "";
        
        while ($this->httpClient->getPayload()->ready()) {
            $response .= $this->httpClient->getPayload()->read($this->httpClient->getPayload()
                ->count());
        }
        
        return $response;
    }
    
    /**
     * Provide an URL object out of given duckduckgo query
     * @param string $query
     * @return Url
     */
    private function provideUrl(string $query): Url
    {
        $url = new Url(sprintf("http://api.duckduckgo.com/?q=%s&format=json", urlencode($query)));
        
        return $url;
    }
}
