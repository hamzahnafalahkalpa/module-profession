<?php

namespace Hanafalah\ModuleProfession\Schemas;

use Hanafalah\ModuleProfession\Contracts\Data\OccupationData;
use Hanafalah\ModuleProfession\Contracts\Schemas\Occupation as ContractsOccupation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Profession implements ContractsOccupation
{
    protected string $__entity = 'Occupation';
    public static $occupation_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'occupation',
            'tags'     => ['occupation', 'occupation-index'],
            'forever'  => true
        ]
    ];

    public function prepareStoreOccupation(OccupationData $occupation_dto): Model
    {
        $model = parent::prepareStoreProfession($occupation_dto);
        $this->forgetTags('occupation');
        return static::$occupation_model = $model;
    }

    public function occupation(mixed $conditionals = null): Builder{
        return $this->generalSchemaModel()->whereNull('parent_id');
    }
}
