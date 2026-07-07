<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ParticipantRequest;
use App\Models\Event;
use App\Services\ParticipantService;
use Illuminate\Http\JsonResponse;

class ParticipantController extends Controller
{
    public function __construct(
        protected ParticipantService $participantService
    ) {}

    /**
     * Register the authenticated user for an event.
     */
    public function register(ParticipantRequest $request, Event $event): JsonResponse
    {
        return $this->participantService->registerParticipant($event);
    }

    /**
     * Retrieve all participants registered for an event.
     */
    public function index(Event $event): JsonResponse
    {
        return $this->participantService->index($event);
    }

    /**
     * Cancel the authenticated user's event registration.
     */
    public function destroy(Event $event): JsonResponse
    {
        return $this->participantService->cancelRegistration($event);
    }
}