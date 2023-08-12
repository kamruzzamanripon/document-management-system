<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Services\UserService;


class RegisteredUserController extends Controller
{
    protected UserService $userService;

    /**
     * Initialize userService object
     *
     * @param UserService $zipcodeService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): mixed
    {
        $user = $this->userService->register($request->all());
        $transformed = new RegisterResource($user);

        //dd($transformed);
        return $this->successResponse(
            $transformed,
            'User info saved'
        );
    }

    
}
