<?php

namespace Hanafalah\ModuleProfession\Schemas;

use Hanafalah\ModuleProfession\Contracts\Schemas\JobDesk as ContractsJobDesk;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleProfession\Enums\Profession\Flag;

class JobDesk extends Profession implements ContractsJobDesk
{
    protected string $__entity = 'JobDesk';
    public static $job_desk_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'job-desk',
            'tags'     => ['job-desk', 'job-desk-index'],
            'forever'  => true
        ]
    ];

    public function getJobDesk(): mixed{
        return static::$job_desk_model;
    }

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function prepareShowJobDesk(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getJobDesk();
        if (!isset($model)) {
            $id    = $attributes['id'] ?? null;
            if (!isset($id)) throw new \Exception('No job-desk id provided', 422);

            $model = $this->jobDesk()->with($this->showUsingRelation())->findOrFail($attributes['id']);
        } else {
            $model->load($this->showUsingRelation());
        }

        return static::$job_desk_model = $model;
    }

    public function showJobDesk(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowJobDesk($model);
        });
    }

    public function prepareStoreJobDesk(?array $attributes = null): Model{
        $attributes ??= request()->all();

        if (!isset($attributes['name'])) throw  new \Exception('name is required');

        $model = $this->JobDeskModel()->updateOrCreate([
            'id' => $attributes['id'] ?? null
        ], [
            'name' => $attributes['name'],
            'flag' => $attributes['flag'] ?? Flag::JOB_DESK->value
        ]);

        $this->forgetTags('job-desk');
        return static::$job_desk_model = $model;
    }

    public function storeJobDesk(): array{
        return $this->transaction(function () {
            return $this->showJobDesk($this->prepareStoreJobDesk());
        });
    }

    public function prepareViewJobDeskList(?array $attributes = null): Collection
    {
        $attributes ??= request()->all();

        return static::$job_desk_model = $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () {
            return $this->jobDesk()->get();
        });
    }

    public function viewJobDeskList(): array{
        return $this->viewEntityResource(function() {
            return $this->prepareViewJobDeskList();
        });
    }

    public function prepareDeleteJobDesk(?array $attributes = null): bool
    {
        $attributes ??= request()->all();

        if (!isset($attributes['id'])) throw new \Exception('No job-desk id provided', 422);
        $result = $this->JobDeskModel()->destroy($attributes['id']);
        $this->forgetTags('job-desk');
        return $result;
    }

    public function deleteJobDesk(): bool
    {
        return $this->transaction(function () {
            return $this->prepareDeleteJobDesk();
        });
    }

    public function jobDesk(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->JobDeskModel()->withParameters()
                    ->conditionals($this->mergeCondition($conditionals ?? []))
                    ->orderBy('name', 'asc');
    }
}
