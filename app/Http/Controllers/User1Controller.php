<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Services\User1Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class User1Controller extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the User1 Microservice
     * @var User1Service
     */
    public $user1Service;

    private $request; // Keep this if you need it

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(Request $request, User1Service $user1Service) // Inject User1Service
    {
        $this->request = $request;
        $this->user1Service = $user1Service;
    }

    /**
     * Return the list of users from Site 1
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = $this->user1Service->obtainUsers1();
            return $this->successResponse(json_decode($users, true)); // Decode to associative array
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function add(Request $request)
    {
        try {
            $user = $this->user1Service->createUser1($request->all());
            return $this->successResponse(json_decode($user, true), Response::HTTP_CREATED);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Obtains and show one user
     * @param  int|string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->user1Service->obtainUser1($id);
            return $this->successResponse(json_decode($user, true));
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update an existing user
     * @param  \Illuminate\Http\Request  $request
     * @param  int|string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $response = $this->user1Service->editUser1($request->all(), $id);
            return $this->successResponse(json_decode($response, true));
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $this->user1Service->deleteUser1($id);
            return $this->successResponse(['message' => 'User deleted successfully']);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}