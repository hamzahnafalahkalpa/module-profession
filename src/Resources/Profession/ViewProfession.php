<?php

namespace Hanafalah\ModuleProfession\Resources\Profession;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewProfession extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'        => $this->id,
            'parent_id' => $this->parent_id,
            'name'      => $this->name,
            'childs' => $this->relationValidation('childs', function () {
                return $this->childs->transform(function ($child) {
                    return $child->toViewApi();
                });
            }),
            'tariff_components' => $this->relationValidation('tariffComponents', function () {
                return $this->tariffComponents->transform(function ($tariffComponent) {
                    return $tariffComponent->toViewApi();
                });
            })
        ];

        return $arr;
    }
}
