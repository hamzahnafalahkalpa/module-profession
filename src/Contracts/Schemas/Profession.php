<?php

namespace Hanafalah\ModuleProfession\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

interface Profession extends DataManagement
{
    public function getProfession(): mixed;
    public function prepareShowProfession(?Model $model = null): ?Model;
    public function showProfession(?Model $model = null): array;
    public function prepareStoreProfession(?array $attributes = null): Model;
    public function storeProfession(): array;
    public function prepareViewProfessionList(): Collection;
    public function viewProfessionList(): array;
    public function profession(mixed $conditionals = null): Builder;
    public function addOrChange(?array $attributes = []): self;
}
