<?php

namespace Hanafalah\ModuleProfession\Schemas;

use Hanafalah\ModuleProfession\Contracts\Schemas\Occupation as ContractsOccupation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleProfession\Enums\Profession\Flag;
use Hanafalah\ModuleProfession\Resources\Occupation\ShowOccupation;
use Hanafalah\ModuleProfession\Resources\Occupation\ViewOccupation;

class Occupation extends Profession implements ContractsOccupation
{
    protected string $__entity = 'Occupation';
    public static $occupation_model;

    protected array $__resources = [
        'view' => ViewOccupation::class,
        'show' => ShowOccupation::class
    ];

    protected array $__cache = [
        'index' => [
            'name'     => 'occupation',
            'tags'     => ['occupation', 'occupation-index'],
            'forever'  => true
        ]
    ];

    public function getOccupation(): mixed
    {
        return static::$occupation_model;
    }

    public function showUsingRelation(): array
    {
        return [];
    }

    public function prepareShowOccupation(?Model $model = null, ?array $attributes = null): Model
    {
        $attributes ??= request()->all();

        $model ??= $this->getOccupation();
        if (!isset($model)) {
            $id    = $attributes['id'] ?? null;
            if (!isset($id)) throw new \Exception('No occupation id provided', 422);

            $model = $this->occupation()->with($this->showUsingRelation())->findOrFail($attributes['id']);
        } else {
            $model->load($this->showUsingRelation());
        }

        return static::$occupation_model = $model;
    }

    public function showOccupation(?Model $model = null): array
    {
        return $this->transforming($this->__resources['show'], function () use ($model) {
            return $this->prepareShowOccupation($model);
        });
    }

    public function prepareStoreOccupation(?array $attributes = null): Model
    {
        $attributes ??= request()->all();

        if (!isset($attributes['name'])) throw  new \Exception('name is required');

        $model = $this->OccupationModel()->updateOrCreate([
            'id' => $attributes['id'] ?? null
        ], [
            'name' => $attributes['name'],
            'flag' => $attributes['flag'] ?? Flag::OCCUPATION->value
        ]);

        $this->forgetTags('occupation');
        return static::$occupation_model = $model;
    }

    public function storeOccupation(): array
    {
        return $this->transaction(function () {
            return $this->showOccupation($this->prepareStoreOccupation());
        });
    }

    public function prepareViewOccupationList(?array $attributes = null): Collection
    {
        $attributes ??= request()->all();

        return static::$occupation_model = $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () {
            return $this->occupation()->get();
        });
    }

    public function viewOccupationList(): array
    {
        return $this->transforming($this->__resources['view'], function () {
            return $this->prepareViewOccupationList();
        });
    }

    public function prepareDeleteOccupation(?array $attributes = null): bool
    {
        $attributes ??= request()->all();

        if (!isset($attributes['id'])) throw new \Exception('No occupation id provided', 422);
        $result = $this->OccupationModel()->destroy($attributes['id']);
        $this->forgetTags('occupation');
        return $result;
    }

    public function deleteOccupation(): bool
    {
        return $this->transaction(function () {
            return $this->prepareDeleteOccupation();
        });
    }

    public function occupation(mixed $conditionals = null): Builder
    {
        $this->booting();
        return $this->OccupationModel()->withParameters()->conditionals($conditionals)->orderBy('name', 'asc');
    }
}
