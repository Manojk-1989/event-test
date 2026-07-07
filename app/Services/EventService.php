<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class EventService
{
    /**
     * Retrieve all events with creator details.
     */
    public function index(): JsonResponse
    {
        $events = Event::with('creator')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Events retrieved successfully.',
            'data' => $events,
        ]);
    }

    /**
     * Create a new event.
     */
    public function store(array $data): JsonResponse
    {
        $event = Event::create([
            'created_by' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'venue' => $data['venue'],
            'event_date' => $data['event_date'],
            'capacity' => $data['capacity'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully.',
            'data' => $event,
        ], 201);
    }

    /**
     * Retrieve a specific event with related details.
     */
    public function show(Event $event): JsonResponse
    {
        $event->load('creator', 'participants');

        return response()->json([
            'success' => true,
            'message' => 'Event retrieved successfully.',
            'data' => $event,
        ]);
    }

    /**
     * Update an existing event.
     */
    public function update(Event $event, array $data): JsonResponse
    {
        // Ensure only the event creator can update the event
        if ($event->created_by !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        $event->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'venue' => $data['venue'],
            'event_date' => $data['event_date'],
            'capacity' => $data['capacity'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully.',
            'data' => $event->fresh(),
        ]);
    }

    /**
     * Delete an existing event.
     */
    public function destroy(Event $event): JsonResponse
    {
        // Ensure only the event creator can delete the event
        if ($event->created_by !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully.',
        ]);
    }
}