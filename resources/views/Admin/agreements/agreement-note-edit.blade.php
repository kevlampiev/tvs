@extends('layouts.admin')

@section('title')
    Администратор|Изменение заметки
@endsection

@section('content')
    <h3> @if ($agreementNote->id) Редактирование заметки @else Добавить заметку @endif</h3>
    <form
        @if($agreementNote->id)
            action="{{route('admin.editAgreementNote', ['agreementNote' => $agreementNote->id])}}"
        @else
            action="{{route('admin.addAgreementNote', ['agreement' => $agreementNote->agreement->id])}}"
        @endif
        method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Договор</label>
                <input type="hidden"
                       id="agreement_id" name="agreement_id" value="{{$agreementNote->agreement_id}}">
                <input type="text"
                       id="input-agreement" name="agreement" value="{{$agreementNote->agreement->name}}" disabled>
            </div>

            <div class="form-group">
                <label for="description">Текст заметки</label>
                <textarea class="form-control {{$errors->has('note_body')?'is-invalid':''}}"
                          id="note_body"
                          rows="13" name="note_body">{{$agreementNote->note_body}}</textarea>
            </div>
            @if ($errors->has('note_body'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('note_body') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <button type="submit" class="btn btn-primary">
                @if ($agreementNote->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary"
               href="{{route('admin.agreementSummary',['agreement'=>$agreementNote->agreement_id, 'page' => 'notes'])}}">
                Отмена
            </a>

        </form>

    </form>


@endsection
