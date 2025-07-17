<?php

namespace Hanafalah\ModuleProfession\Contracts\Schemas;

use Hanafalah\ModuleProfession\Contracts\Data\JobDeskData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleProfession\Schemas\JobDesk
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method bool deleteJobDesk()
 * @method bool prepareDeleteJobDesk(? array $attributes = null)
 * @method mixed getJobDesk()
 * @method ?Model prepareShowJobDesk(?Model $model = null, ?array $attributes = null)
 * @method array showJobDesk(?Model $model = null)
 * @method Collection prepareViewJobDeskList()
 * @method array viewJobDeskList()
 * @method LengthAwarePaginator prepareViewJobDeskPaginate(PaginateData $paginate_dto)
 * @method array viewJobDeskPaginate(?PaginateData $paginate_dto = null)
 * @method array storeJobDesk(?JobDeskData $job_desk_dto = null)s
 */
interface JobDesk extends Occupation
{
    public function prepareStoreJobDesk(JobDeskData $job_desk_dto): Model;
    public function jobDesk(mixed $conditionals = null): Builder;
}
