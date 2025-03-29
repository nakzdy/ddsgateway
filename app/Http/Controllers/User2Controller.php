<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Services\User2Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class User2Controller extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the User1 Microservice
     * @var User2Service
     */
    public $user2Service;

    private $request; // Keep this if you need it

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(Request $request, User2Service $user2Service) 
    {
        $this->request = $request;
        $this->user2Service = $user2Service;
    }

    /**
     * Return the list of users from Site 2
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = $this->user2Service->obtainUsers2();
            return $this->successResponse(json_decode($users, true));
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function add(Request $request)
    {
        try {
            $user = $this->user2Service->createUser2($request->all());
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
            $user = $this->user2Service->obtainUser2($id);
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
            $response = $this->user2Service->editUser2($request->all(), $id);
            return $this->successResponse(json_decode($response, true));
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $this->user2Service->deleteUser2($id);
            return $this->successResponse(['message' => 'User deleted successfully']);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}