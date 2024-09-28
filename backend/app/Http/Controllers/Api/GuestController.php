<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\GuestException;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Guest\CreateRequest;
use App\Http\Requests\Api\Guest\UpdateRequest;
use App\Models\Guest;
use App\Services\Api\GuestService;
use Illuminate\Http\JsonResponse;

class GuestController extends ApiController
{
    public function __construct(
        private readonly GuestService $guestService
    )
    {
        $this->collectingStatistic();
    }

    public function index(): JsonResponse
    {
        try {
            $result = $this->guestService->index();
            return $this->response($result);
        } catch (GuestException $e) {
            return $this->responseError($e->getMessage(), 500);
        }
    }

    public function create(CreateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $result = $this->guestService->create($data);
            return $this->response($result);
        } catch (GuestException $e) {
            return $this->responseError($e->getMessage(), 500);
        }
    }

    public function update(UpdateRequest $request, Guest $guest): JsonResponse
    {
        try {
            $data = $request->validated();
            $result = $this->guestService->update($data, $guest);
            return $this->response($result);
        } catch (GuestException $e) {
            return $this->responseError($e->getMessage(), 500);
        }
    }

    public function destroy(Guest  $guest): JsonResponse
    {
        try {
            $result = $this->guestService->destroy($guest);
            return $this->response($result);
        } catch (GuestException $e) {
            return $this->responseError($e->getMessage(), 500);
        }
    }
}
