<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class User2Service
{
    use ConsumesExternalService;

    /**
     * the base uri to consume the user1 service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the User2 Service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.users2.base_uri');
        $this->secret = config('services.users2.secret');
    }

    /**
     * Obtain the full list of Users from User2 Site
     * @return string
     */
    public function obtainUsers2()
    {
        try {
            return $this->makeRequest('GET', '/api/users');
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $errorMessage = $this->extractErrorMessage($e->getResponse()->getBody()->getContents());
            return json_encode(['error' => $errorMessage, 'code' => $e->getResponse()->getStatusCode(), 'site' => 2]);
        }
    }

    /**
     * Create one user using the User2 service
     * @param array $data
     * @return string
     */
    public function createUser2(array $data)
    {
        try {
            return $this->makeRequest('POST', '/api/users', $data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $errorMessage = $this->extractErrorMessage($e->getResponse()->getBody()->getContents());
            return json_encode(['error' => $errorMessage, 'code' => $e->getResponse()->getStatusCode(), 'site' => 2]);
        }
    }

    public function obtainUser2($id)
    {
        try {
            return $this->makeRequest('GET', "/api/users/{$id}");
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $errorMessage = $this->extractErrorMessage($e->getResponse()->getBody()->getContents());
            return json_encode(['error' => $errorMessage, 'code' => $e->getResponse()->getStatusCode(), 'site' => 2]);
        }
    }

    public function editUser2(array $data, $id)
    {
        try {
            return $this->makeRequest('PUT', "/api/users/{$id}", $data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $errorMessage = $this->extractErrorMessage($e->getResponse()->getBody()->getContents());
            return json_encode(['error' => $errorMessage, 'code' => $e->getResponse()->getStatusCode(), 'site' => 2]);
        }
    }

    public function deleteUser2($id)
    {
        try {
            return $this->makeRequest('DELETE', "/api/users/{$id}");
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $errorMessage = $this->extractErrorMessage($e->getResponse()->getBody()->getContents());
            return json_encode(['error' => $errorMessage, 'code' => $e->getResponse()->getStatusCode(), 'site' => 2]);
        }
    }

    /**
     * Helper function to extract the error message from a JSON response.
     *
     * @param string $responseBody
     * @return string|null
     */
    protected function extractErrorMessage($responseBody)
    {
        $decodedResponse = json_decode($responseBody, true);
        return $decodedResponse['error'] ?? null;
    }
}