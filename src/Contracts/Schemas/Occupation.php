<?php

namespace Hanafalah\ModuleProfession\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Occupation extends Profession
{
    public function getOccupation(): mixed;
    public function prepareShowOccupation(?Model $model = null, ?array $attributes = null): Model;
    public function showOccupation(?Model $model = null): array;
    public function prepareStoreOccupation(?array $attributes = null): Model;
    public function storeOccupation(): array;
    public function prepareViewOccupationList(?array $attributes = null): Collection;
    public function viewOccupationList(): array;
    public function prepareDeleteOccupation(?array $attributes = null): bool;
    public function deleteOccupation(): bool;
    public function occupation(mixed $conditionals = null): Builder;
}
