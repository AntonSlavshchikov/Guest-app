<?php
declare(strict_types=1);

namespace App\Services\Api;

use App\Contract\ApiServiceContract;
use App\Exceptions\GuestException;
use App\Models\Guest;
use App\Services\PhoneService;
use Illuminate\Database\Eloquent\Model;

class GuestService implements ApiServiceContract
{
    /**
     * @throws GuestException
     */
    public function index(): array
    {
        try {
            return Guest::get()->toArray();
        } catch (\Exception $e) {
            throw new GuestException($e->getMessage());
        }
    }

    /**
     * @throws GuestException
     */
    public function create(array $data): array
    {
        try {
            if(empty($data['country'])) {
                $data['country'] = PhoneService::getCountry($data['phone']);
            }

            $guest = Guest::create($data);
            return $guest->toArray();
        } catch (\Exception $e) {
            throw new GuestException($e->getMessage());
        }
    }

    /**
     * @throws GuestException
     */
    public function update(array $data, Model $model): array
    {
        try {
            $model->fill($data);
            $model->save();

            return $model->toArray();
        } catch (\Exception $e) {
            throw new GuestException($e->getMessage());
        }
    }

    /**
     * @throws GuestException
     */
    public function destroy(Model $model): bool
    {
        try {
            return $model->delete();
        } catch (\Exception $e) {
            throw new GuestException($e->getMessage());
        }
    }
}
