<?php

namespace Hanafalah\ModuleProfession\Contracts\Schemas;

use Hanafalah\ModuleProfession\Contracts\Data\OccupationData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleProfession\Schemas\Occupation
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method bool deleteOccupation()
 * @method bool prepareDeleteOccupation(? array $attributes = null)
 * @method mixed getOccupation()
 * @method ?Model prepareShowOccupation(?Model $model = null, ?array $attributes = null)
 * @method array showOccupation(?Model $model = null)
 * @method Collection prepareViewOccupationList()
 * @method array viewOccupationList()
 * @method LengthAwarePaginator prepareViewOccupationPaginate(PaginateData $paginate_dto)
 * @method array viewOccupationPaginate(?PaginateData $paginate_dto = null)
 * @method array storeOccupation(?OccupationData $occupation_dto = null)s
 */
interface Occupation extends Profession
{
    public function prepareStoreOccupation(OccupationData $occupation_dto): Model;
    public function occupation(mixed $conditionals = null): Builder;
}
