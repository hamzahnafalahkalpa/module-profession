<?php

namespace Hanafalah\ModuleProfession\Schemas;

use Hanafalah\ModuleProfession\Contracts\Data\JobDeskData;
use Hanafalah\ModuleProfession\Contracts\Schemas\JobDesk as ContractsJobDesk;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class JobDesk extends Occupation implements ContractsJobDesk
{
    protected string $__entity = 'JobDesk';
    public static $job_desk_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'job_desk',
            'tags'     => ['job_desk', 'job_desk-index'],
            'forever'  => true
        ]
    ];

    public function prepareStoreJobDesk(JobDeskData $job_desk_dto): Model{
        $occupation = $this->prepareStoreOccupation($job_desk_dto);
        return static::$job_desk_model = $occupation;
    }

    public function jobDesk(mixed $conditionals = null): Builder{
        return $this->occupation($conditionals);
    }
}
