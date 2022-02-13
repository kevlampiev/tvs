@extends('layouts.admin')

@section('title')
    Администратор|Изменение документа
@endsection

@section('content')
    <h3> @if ($document->id) Изменение данных@else Добавить новый документ@endif</h3>
    <form method="POST" enctype="multipart/form-data">
        @csrf

            <div class="row">
                <div class="col-md-12">

                    <input type="hidden" name="task_id" value="{{$document->task_id}}">
                    <input type="hidden" name="vehicle_id" value="{{$document->vehicle_id}}">
                    <input type="hidden" name="agreement_id" value="{{$document->agreement_id}}">
                    <input type="hidden" name="insurance_id" value="{{$document->insurance_id}}">

                    {{--  название файла  --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="description">Наименование документа</span>
                        <input type="text"
                               class="form-control {{$errors->has('description')?'is-invalid':''}}"
                               aria-describedby="description"
                               name="description"
                               value="{{$document->description}}">
                    </div>
                    @if ($errors->has('description'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('description') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{--  загрузка файла  --}}
                    <div class="input-group mb-3">
                        @if($document->file_name)
                            <a href="{{route('user.filePreview', ['filename'=>$document->file_name])}}">
                                <i class="bi bi-file-earmark-pdf"> Открыть файл </i>
                            </a>
                        @endif
                        <span class="ml-4 mr-4" id="file-status">
                            {{$document->file_name?"Файл доступен для скачивания":"Файл документа отсутствует"}}
                        </span>
                        <a href="#" class="btn btn-outline-secondary" id="policy_file"
                           onclick="uploadFile()">
                            Загрузить новый файл документа
                        </a>
                        <input type="file" class="form-control-file" id="inputGroupFile01" name="document_file"
                               accept=".doc,.docx,application/msword,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                               aria-describedby="policy_file" style="display: none;">

                    </div>
                    @if ($errors->has('document_file'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('document_file') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>


            </div>



            <button type="submit" class="btn btn-primary">
                @if ($document->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.taskCard', ['task' => $document->task_id])}}">Отмена</a>

    </form>


@endsection

@section('scripts')
    <script>
        function uploadFile()
        {
            document.getElementById('inputGroupFile01').click()
            document.getElementById('file-status').textContent='Файл будет доступен после сохранения записи'
        }
    </script>
@endsection
