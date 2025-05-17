<?php

namespace Hanafalah\ModuleProfession\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleProfession\Contracts\Data\ProfessionData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleProfession\Schemas\Profession
 * @method self conditionals(mixed $conditionals)
 * @method bool deleteProfession()
 * @method bool prepareDeleteProfession(? array $attributes = null)
 * @method mixed getProfession()
 * @method ?Model prepareShowProfession(?Model $model = null, ?array $attributes = null)
 * @method array showProfession(?Model $model = null)
 * @method Collection prepareViewProfessionList()
 * @method array viewProfessionList()
 * @method LengthAwarePaginator prepareViewProfessionPaginate(PaginateData $paginate_dto)
 * @method array viewProfessionPaginate(?PaginateData $paginate_dto = null)
 * @method array storeProfession(?ProfessionData $profession_dto = null)
 */
interface Profession extends DataManagement
{
    public function prepareStoreProfession(ProfessionData $profession_dto): Model;
    public function profession(mixed $conditionals = null): Builder;
}
