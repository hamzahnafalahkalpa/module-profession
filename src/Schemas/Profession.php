<?php

namespace Hanafalah\ModuleProfession\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleProfession\Contracts\Schemas\Profession as ContractsProfession;
use Hanafalah\ModuleProfession\Data\ProfessionData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Profession extends PackageManagement implements ContractsProfession
{
    protected string $__entity = 'Profession';
    public static $profession_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'profession',
            'tags'     => ['profession', 'profession-index'],
            'forever'  => true
        ]
    ];

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function getProfession(): mixed{
        return static::$profession_model;
    }

    public function prepareShowProfession(?Model $model = null): ?Model{
        $model ??= $this->getProfession();
        if (!isset($model)){
            $id = request()->id;
            if (!isset($id)) throw new \Exception('No id provided', 422);
            $model = $this->profession()->with($this->showUsingRelation())->find($id);
        }else{
            $model->load($this->showUsingRelation());
        }
        return static::$profession_model = $model;
    }

    public function showProfession(?Model $model = null): array{
        return $this->showEntityResource(fn() => $this->prepareShowProfession($model));
    }

    public function prepareStoreProfession(ProfessionData $profession_dto): Model{            
        $profession = $this->ProfessionModel()->updateOrCreate([
            'name' => $profession_dto->name,
            'flag' => $profession_dto->flag
        ]);

        // $this->schemaContract('price_component')->prepareStorePriceComponent($this->assocRequest(
        //     'tariff_components',
        //     ...[
        //         'model_id'   => $profession->getKey(),
        //         'model_type' => $profession->getMorphClass(),
        //     ],
        // ));
        
        $this->forgetTags('profession');
        return static::$profession_model = $profession;
    }

    public function storeProfession(? ProfessionData $profession_dto = null): array{
        return $this->transaction(function() use ($profession_dto) {
            return $this->showProfession($this->prepareStoreProfession($profession_dto ?? $this->requestDTO(ProfessionData::class)));
        });
    }

    public function prepareViewProfessionList(): Collection{
        return static::$profession_model = $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () {
            $professions = $this->profession()->with('tariffComponents')->whereNull('parent_id')->orderBy('name', 'asc')->get();
            foreach ($professions as $profession) {
                $this->inheritenceLoad($profession, 'childs', function ($query) {
                    $query->with('tariffComponents');
                });
            }
            return $professions;
        });
    }

    public function viewProfessionList(): array{
        return $this->viewEntityResource(fn()=>$this->prepareViewProfessionList());
    }

    public function profession(mixed $conditionals = null): Builder{
        return $this->ProfessionModel()->withParameters()->conditionals($this->mergeCondition($conditionals ?? []));
    }
}
