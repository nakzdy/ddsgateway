<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class User1Service
{
    use ConsumesExternalService;

    public function __construct()
    {
        $this->baseUri = config('services.users1.base_uri');
    }

    /**
     * Obtain the full list of Users from User1 Site
     * @return string
     */
    public function obtainUsers1()
    {
        try {
            return $this->makeRequest('GET', '/api/users'); // Add the /api/ prefix here
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return json_encode(['error' => $e->getMessage(), 'code' => 500, 'site' => 1]); // Add site info
        }
    }

    /**
     * Create one user using the User1 service
     * @param array $data
     * @return string
     */
    public function createUser1(array $data)
    {
        try {
            return $this->makeRequest('POST', '/api/users', $data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return json_encode(['error' => $e->getMessage(), 'code' => 500, 'site' => 1]); // Add site info
        }
    }

    public function obtainUser1($id)
    {
        try {
            return $this->makeRequest('GET', "/api/users/{$id}");
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return json_encode(['error' => $e->getMessage(), 'code' => 500, 'site' => 1]); // Add site info
        }
    }

    public function editUser1(array $data, $id)
    {
        try {
            return $this->makeRequest('PUT', "/api/users/{$id}", $data);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return json_encode(['error' => $e->getMessage(), 'code' => 500, 'site' => 1]); // Add site info
        }
    }

    public function deleteUser1($id)
    {
        try {
            return $this->makeRequest('DELETE', "/api/users/{$id}");
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return json_encode(['error' => $e->getMessage(), 'code' => 500, 'site' => 1]); // Add site info
        }
    }
}