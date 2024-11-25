## Install :notebook:

1. Just add this line to your composer.json file of your laravel package
```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/GerardProgrammeert/jira-client.git"
        }
    ],
```

2. Run Composer install `composer install`
    This will not only download the package, but also push the JiraServiceProvider
3. If you wish you can publish the config file of this package, please run `vendor:publish`   


## Usage :hammer:
The JiraServiceProvider creates a new JiraClient as a singleton. 
Via Dependency Injection
```php
public function handle(JiraClient $client): void
{
    $responsePayloadIssue = $client->issue()->get(`SCRUM`); 
} 
```
With the helper function resolve()
```php 
public function handle(): void
{
    $client = resolve(AbstractClient::class); 
    $responsePayloadIssue = $client->issue()->get(`SCRUM`); 
} 
```

With the JiraClientFactory

```php 
public function handle(): void
{
    $client=JiraClientFactory::create()
    $responsePayloadIssue = $client->issue()->get(`SCRUM`); 
} 
```


## Logging :newspaper:
If you are curious what is send to and from Jira, you can log the body of the requests and responses.\
Just add this to your .env file:
```text
JIRA_LOG_REQUEST=true
JIRA_LOG_RESPONSE=true
```

The data will be stored in `storage/app/jira-client`

## FakerClient :santa:
This package also provide a FakerClient for testing purposes.\
The FakerClient has fixture, which is used to create the responses.\
TODO






