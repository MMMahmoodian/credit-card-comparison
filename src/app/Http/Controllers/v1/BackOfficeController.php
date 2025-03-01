<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\BackOffice\StoreEditRequest;
use App\Models\CreditCard;

class BackOfficeController extends Controller
{
    public function storeEdit(StoreEditRequest $request)
    {
        $inputs = $request->validated();
        $edits = $request->only('edits');
        $entity = $this->getEditableEntity($inputs['product_type'], $inputs['id']);

        if ($entity->edit()->exists()){
            $entity->edit()->update($edits);
        }else{
            $entity->edit()->create($edits);
        }

        return response()->json(['message' => 'Edit created successfully']);
    }

    private function getEditableEntity(string $entity_name, int $entity_id)
    {
        // when we have a complex system with multiple entities we can use a match statement to select the correct entity
        return CreditCard::query()->find($entity_id);
    }
}
