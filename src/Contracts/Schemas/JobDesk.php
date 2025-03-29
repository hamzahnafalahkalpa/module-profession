<?php

namespace Hanafalah\ModuleProfession\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface JobDesk extends Profession
{
    public function getJobDesk(): mixed;
    public function prepareShowJobDesk(?Model $model = null, ?array $attributes = null): Model;
    public function showJobDesk(?Model $model = null): array;
    public function prepareStoreJobDesk(?array $attributes = null): Model;
    public function storeJobDesk(): array;
    public function prepareViewJobDeskList(?array $attributes = null): Collection;
    public function viewJobDeskList(): array;
    public function prepareDeleteJobDesk(?array $attributes = null): bool;
    public function deleteJobDesk(): bool;
    public function jobDesk(mixed $conditionals = null): Builder;
}
