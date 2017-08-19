# Usage

composer.json

```javascript
{
    "require" : {
        "php" : ">=7.0",
        "nkey/ddg-api" : "dev-master"
    }
}
```

Example php script:

```php
use Nkey\DDG\API\JsonProvider;
use Nkey\DDG\API\QueryResultParser;

$provider = new JsonProvider();
$json = $provider->query("mount rushmore");

$parser = new QueryResultParser();
$results = $parser->parseQueryResult($json);

foreach($results->getRelatedTopics() as $relatedTopic) {
    printf('<a href="%s">%s</a>', $relatedTopic->getFirstURL(), $relatedTopic->getText());
}
```