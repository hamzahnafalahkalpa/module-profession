<?php

namespace Hanafalah\ModuleProfession\Models\Profession;

use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleProfession\Enums\Profession\Flag;
use Hanafalah\ModulePayment\Concerns\HasPriceComponent;
use Hanafalah\ModuleProfession\Concerns\Relation\HasJobDesk;
use Hanafalah\ModuleProfession\Resources\Profession\{
    ShowProfession, ViewProfession
};

class Profession extends BaseModel
{
    use HasPriceComponent, HasJobDesk;

    public $timestamps  = false;
    protected $fillable = ['id', 'parent_id', 'flag', 'name'];
    protected static array $__flags = [];

    protected static function booted(): void{
        parent::booted();
        static::addGlobalScope('flag', function ($query) {
            $query->flagIn(static::getFlag());
        });
        static::creating(function ($query) {
            $query->flag = static::getFlag();
        });
    }

    public static function getFlag(): string{
        return Flag::PROFESSION->value;
    }

    public function viewUsingRelation(): array{
        return ['childs'];
    }

    public function showUsingRelation(): array{
        return ['childs'];
    }

    public function getViewResource(){
        return ViewProfession::class;
    }

    public function getShowResource(){
        return ShowProfession::class;
    }

    public function childs(){
        return $this->hasManyModel($this->getMorphClass(), static::getParentId())->withoutGlobalScopes()->with(['childs']);
    }
}
