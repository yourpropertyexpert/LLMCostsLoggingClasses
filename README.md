# LLMCostsLoggingClasses
This repo contains the source code for the PHP class you might need to log into llmcosts.fyi

We wouldn't normally expect you to need to install from source, and this code is typically very simple

You need an API key from llmcosts.fyi. Reference code, prepopulated with your API key is available to users of that site, but the quick version is here.

For use with other clients, you will also need to replace the name "OpenAI" in the ->logCall function with a provider supported by the service.

### Installation

The best way is to install via Composer, by adding to the "require" section of your composer.json file

```
{... other requirements ...}
"llmcosts/llm-cost-logger": "1.0.0"
```

### Using with the OpenAI client:

```diff
/**
 * Your existing code
 */
$client = \OpenAI::Client("<your OpenAI token>");
$result = $client->chat()->create([
    'model' => self::MODEL,
    'messages' => [
        ['role' => 'user', 'content' => '<your query string>'],
    ],
]);
$resultArray = $result->toArray();

/**
 * The two lines you need to add logging
 * The <provider> can be anything, but see above
 */
+ $costLogger = new LLMCostLogger("{{key}}");
+ $costLogger->logCall("OpenAI", $resultArray);
```
