<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumeMicroserviceService
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        
        $client = new Client([
            'base_uri'  =>  $this->baseUri,
        ]);
        
        $response = $client->request($method, $requestUrl, [
            'form_params' => $formParams,
            'headers'     => ['Authorization' => $this->secret],
        ]);

        
        return $response->getBody()->getContents();
    }
    
}