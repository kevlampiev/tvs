<?php


namespace App\DataServices\Admin;


use App\Models\GuaranteeIndividual;
use App\Models\GuaranteeLegalEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GuaranteesLegalEntitysDataService implements DataServiceInterface
{

    public static function getAll()
    {
        return GuaranteeIndividual::all();
    }

    public static function getSelected(Request $request)
    {
       $agreement_id = $request->get('agreement_id');
       return GuaranteeLegalEntity::query()->where('agreement_id','=', $agreement_id)->paginate(15);
    }

    public static function provideEditor(GuaranteeLegalEntity $model): array
    {
        // TODO: Implement provideEditor() method.
    }

    public static function create(Request $request, Model $model): Model
    {
        // TODO: Implement create() method.
    }

    public static function edit(Request $request, Model $model)
    {
        // TODO: Implement edit() method.
    }

    public static function saveChanges(Request $request, Model $model)
    {
        // TODO: Implement saveChanges() method.
    }

    public static function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public static function update(Request $request, Model $model)
    {
        // TODO: Implement update() method.
    }

    public static function delete(Model $model)
    {
        // TODO: Implement delete() method.
    }
}
