<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function rules($id = null): array;
    public function list(): LengthAwarePaginator;
    public function store(array $attributes): Model;
    public function find(int $id): ?Model;
    public function update(int $id, array $attributes): bool;
    public function destroy($id): void;
    public function listTrashed(): LengthAwarePaginator;
    public function restore($id): void;
    public function delete($id): void;
    public function hash(string $key): string;
    public function upload(UploadedFile $file): ?string;
}
