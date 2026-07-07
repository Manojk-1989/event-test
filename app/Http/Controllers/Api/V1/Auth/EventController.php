<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\EventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function __construct(
        protected EventService $eventService
    ) {}

    /**
     * Retrieve all events.
     */
    public function index(): JsonResponse
    {
        return $this->eventService->index();
    }

    /**
     * Create a new event.
     */
    public function store(EventRequest $request): JsonResponse
    {
        return $this->eventService->store($request->validated());
    }

    /**
     * Retrieve a specific event.
     */
    public function show(Event $event): JsonResponse
    {
        return $this->eventService->show($event);
    }

    /**
     * Update an existing event.
     */
    public function update(EventRequest $request, Event $event): JsonResponse
    {
        return $this->eventService->update($event, $request->validated());
    }

    /**
     * Delete an existing event.
     */
    public function destroy(Event $event): JsonResponse
    {
        return $this->eventService->destroy($event);
    }
}