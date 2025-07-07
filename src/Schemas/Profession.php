<?php

namespace Hanafalah\ModuleProfession\Schemas;

use Hanafalah\LaravelSupport\Schemas\Unicode;
use Hanafalah\ModuleProfession\Contracts\Data\ProfessionData;
use Hanafalah\ModuleProfession\Contracts\Schemas\Profession as ContractsProfession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Profession extends Unicode implements ContractsProfession
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
        $profession = $this->prepareStoreUnicode($profession_dto);       
        return static::$profession_model = $profession;
    }

    public function profession(mixed $conditionals = null): Builder{
        return $this->unicode($conditionals);
    }
}
