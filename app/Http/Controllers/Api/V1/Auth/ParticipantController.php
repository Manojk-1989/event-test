<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\Auth\ParticipantRequest;
use App\Services\ParticipantService;

class ParticipantController extends Controller
{
    public function __construct(
        protected ParticipantService $participantService
    ) {}

    /**
     * Register a new user.
     */
    public function register(ParticipantRequest $request): JsonResponse
    {
        return $this->$participantService->registerParticipant($request->validated());
    }
}
