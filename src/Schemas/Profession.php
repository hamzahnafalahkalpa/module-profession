<?php

namespace Hanafalah\ModuleProfession\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleProfession\Contracts\Data\ProfessionData;
use Hanafalah\ModuleProfession\Contracts\Schemas\Profession as ContractsProfession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Profession extends PackageManagement implements ContractsProfession
{
    protected string $__entity = 'Profession';
    public static $profession_model;
    protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'profession',
            'tags'     => ['profession', 'profession-index'],
            'forever'  => true
        ]
    ];

    public function prepareStoreProfession(ProfessionData $profession_dto): Model{            
        $add = [
            'name' => $profession_dto->name,
            'flag' => $profession_dto->flag
        ];
        if (isset($profession_dto->id)){
            $guard = ['id' => $profession_dto->id];
            $create = [$guard,$add];
        }else{
            $create = [$add];
        }
        $profession = $this->usingEntity()->updateOrCreate(...$create);

        $this->forgetTags('profession');
        return static::$profession_model = $profession;
    }

    public function profession(mixed $conditionals = null): Builder{
        return $this->generalSchemaModel()->whereNull('parent_id');
    }
}
