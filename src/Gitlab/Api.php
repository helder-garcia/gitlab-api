<?php

namespace Gitlab;

use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

class Api
{


    /**
     * @var ServiceDescription
     */
    protected $description;

    /**
     * @var Client
     */
    protected $client;

    public function __construct($request_options)
    {
        $description = ServiceDescription::factory(__DIR__."/../../clients/index.json");
        $this->client = new Client($request_options['base_url'].'/api/v3');
        $this->client->setDescription($description);
        $this->client->setConfig($request_options);
    }

    /**
     * @param $config
     */
    public function setAccessToken($config)
    {
        $oauth2Plugin = new \Gitlab\Oauth2\Plugin($this, $config);
        $this->client->addSubscriber($oauth2Plugin);
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function getAuthUrl()
    {
        if (! $oauthConfig = $this->client->getConfig("oauth2")) {
            throw new \Exception('OAuth2 authorisation not registered');
        }

        $command = $this->client->getCommand('GetAuthUrl', (array) $oauthConfig)->prepare();
        return $command->getUrl();
    }

    /**
     * @param $code
     * @return array
     *
     * @throws \Exception
     */
    public function getTokens($code)
    {
        if (! $oauthConfig = $this->client->getConfig("oauth2")) {
            throw new \Exception('OAuth2 authorisation not registered');
        }

        $tokens = $this->executeCommand('GetAuthToken',
            array_merge((array) $oauthConfig, array(
                    'code' => $code
                )
            ));

        return $tokens;
    }

    /**
     * @param       $command
     * @param array $arguments
     *
     * @return array
     */
    public function executeCommand($command, $arguments = array())
    {
        $command = $this->client->getCommand($command, $arguments);
        return $this->client->execute($command);/*$command->getResponse()->json();*/
    }
} 