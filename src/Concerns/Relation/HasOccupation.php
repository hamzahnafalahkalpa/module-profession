<?php

namespace Hanafalah\ModuleProfession\Concerns\Relation;

trait HasOccupation
{
    protected $__occupation_foreign_key = 'occupation_id';

    public function initializeHasOccupation()
    {
        $this->mergeFillable([
            $this->__occupation_foreign_key
        ]);
    }

    //EIGER SECTION
    public function occupation()
    {
        return $this->belongsToModel('Occupation');
    }
}
