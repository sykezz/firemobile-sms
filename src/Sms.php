<?php

namespace Sykez\FireMobileSms;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use Log;
use Illuminate\Notifications\Notification;

class Sms
{
	protected $http, $url, $username, $password, $from;

    public function __construct($url, $username, $password, $from, Client $httpClient = null)
    {
		$this->url = $url;
		$this->username = $username;
		$this->password = $password;
		$this->from = $from;
		$this->http = $httpClient;
    }

    protected function httpClient()
    {
		return $this->http ?? new Client();
    }

    public function sendSms($message, $to)
    {
        try {
            $response = $this->httpClient()->post($this->url, 
                [
                    'form_params' => [
                        'gw-username' => $this->username,
						'gw-password' => $this->password,
						'gw-from' => $this->from,
                        'gw-to' => $to,
                        'gw-text' => $this->from.': '.$message->content
                    ],
                    'verify' => false, // Uncomment if SSL certificate issue occurs
			]);

			parse_str($response->getBody()->getContents(), $output); // Parse to get the status

			if ($output['status'] > 0 ) // If status > 0 means something's wrong
				Log::error('SMS Failed.', $output);

            return;
        } catch (ClientException $e) {
			Log::error('SMS Failed.', ['request' => Psr7\str($e->getRequest()), 'response' => Psr7\str($e->getResponse())]);	
        }
    }
}