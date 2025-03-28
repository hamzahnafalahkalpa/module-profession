<?php

namespace Hanafalah\ModuleProfession\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleProfession\Data\ProfessionData;

interface Profession extends DataManagement
{
    public function getProfession(): mixed;
    public function prepareShowProfession(?Model $model = null): ?Model;
    public function showProfession(?Model $model = null): array;
    public function prepareStoreProfession(ProfessionData $profession_dto): Model;            
    public function storeProfession(? ProfessionData $profession_dto = null): array;
    public function prepareViewProfessionList(): Collection;
    public function viewProfessionList(): array;
    public function profession(mixed $conditionals = null): Builder;
    
}
