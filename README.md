# LLMCostsLoggingClasses
This repo contains the source code for the PHP class you might need to log into llmcosts.fyi

We wouldn't normally expect you to need to install from source, and this code is typically very simple

You need an API key from llmcosts.fyi. Reference code, prepopulated with your API key is available to users of that site, but the quick version is here.

Keys
You don't have any keys created, so you'll have the replace the text "Your Key Here" with your llmcosts API key.


If you create a key now, we'll update the code below next time you load this page.


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
 * The <provider> can be anything, but the following values allow us to properly determine token usage
 */
+ $costLogger = new LLMCostLogger("{{key}}");
+ $costLogger->logCall("<provider>", $resultArray);
```
