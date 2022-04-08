<?php


namespace App\DataServices\Admin;


use App\Http\Requests\GuaranteeLegalEntityRequest;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\GuaranteeIndividual;
use App\Models\GuaranteeLegalEntity;
use Error;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuaranteesLegalEntitysDataService // implements DataServiceInterface
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
        return ['guarantee' => $model ,
                'companies' => Company::query()->where('id','<>', $model->agreement->company_id)
                    ->orderBy('name') -> get(),
        ];
    }

    /*
     * Создание модели поручительства с заданым договором
     */
    public static function create(Request $request, Agreement $agreement): GuaranteeLegalEntity
    {
        $guarantee = new GuaranteeLegalEntity();
        $guarantee->fill(['agreement_id'=>$agreement->id,
            'date_open' => $agreement->date_open,
            'date_close'=> $agreement->date_close,
            'user_id' => Auth::user()->id,
            'created_at' => now()
            ]);
        if (!empty($request->old())) {
            $guarantee->fill($request->old());

        }
        return $guarantee;
    }

    public static function saveChanges(GuaranteeLegalEntityRequest $request, GuaranteeLegalEntity $guarantee)
    {
        $guarantee->fill($request->all());
        if (!$guarantee->user_id) $guarantee->user_id = Auth::user()->id;
        if ($guarantee->id) $guarantee->updated_at = now();
        else $guarantee->created_at = now();
        $guarantee->save();
    }

    public static function store(GuaranteeLegalEntityRequest $request)
    {
        try {
            $guarantee = new GuaranteeLegalEntity();
            self::saveChanges($request, $guarantee);
            session()->flash('message', 'Добавлено новое поручительство');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новое поручительство');
        }

    }

    public static function update(GuaranteeLegalEntityRequest $request, GuaranteeLegalEntity $guarantee)
    {
        try {
            self::saveChanges($request, $guarantee);
            session()->flash('message', 'Данные о поручительстве изменены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить данные поручительства');
        }
    }

    public static function delete(GuaranteeLegalEntity $guarantee)
    {
        try {
            $guarantee->delete();
            session()->flash('message', 'Данные о поручительстве удалены');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось удалить данные о поручительстве');
        }
    }


}
