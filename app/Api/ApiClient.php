<?php


namespace App\Api;


class ApiClient
{
    /**
     * @var string
     */
    protected $baseUrl;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return [
            'base_uri' => $this->baseUrl
        ];
    }
}
