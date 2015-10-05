<?php
/**
 * Base class of Services
 */
namespace App\Services;

abstract class Service {
    /**
     * Get HTTP Client
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        return new \GuzzleHttp\Client();
    }
}
