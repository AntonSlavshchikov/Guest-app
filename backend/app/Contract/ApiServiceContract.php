<?php
declare(strict_types=1);

namespace App\Contract;

use Illuminate\Database\Eloquent\Model;

interface ApiServiceContract
{
    public function index(): array;
    public function create(array $data): array;
    public function update(array $data, Model $model): array;
    public function destroy(Model $model): bool;
}
