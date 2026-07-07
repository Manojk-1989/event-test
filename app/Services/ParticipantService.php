<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ParticipantService
{
    /**
     * Register the authenticated user for an event.
     */
    public function registerParticipant(Event $event): JsonResponse
    {
        $user = Auth::user();

        // Check existing registration
        $alreadyRegistered = Participant::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($alreadyRegistered) {
            return response()->json([
                'success' => false,
                'message' => 'You are already registered for this event.',
            ], 409);
        }

        // Check event capacity availability
        $registeredCount = Participant::where('event_id', $event->id)->count();

        if ($registeredCount >= $event->capacity) {
            return response()->json([
                'success' => false,
                'message' => 'Event is full.',
            ], 422);
        }

        // Create participant registration
        $participant = Participant::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully registered for the event.',
            'data' => $participant,
        ], 201);
    }

    /**
     * Retrieve all participants registered for an event.
     */
    public function index(Event $event): JsonResponse
    {
        $participants = $event->participants()
            ->with('user')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Participants retrieved successfully.',
            'data' => $participants,
        ]);
    }

    /**
     * Cancel the authenticated user's event registration.
     */
    public function cancelRegistration(Event $event): JsonResponse
    {
        $user = Auth::user();

        $participant = Participant::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Registration not found.',
            ], 404);
        }

        // Remove participant registration
        $participant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Registration cancelled successfully.',
        ]);
    }
}