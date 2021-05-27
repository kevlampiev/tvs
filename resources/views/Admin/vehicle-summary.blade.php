@extends('Admin.layout')

@section('title')
    Администратор|Просмотр информации о технике
@endsection

@section('content')
    <h3> Информация по единице техники {{$vehicle->name}}</h3>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid animi beatae cumque doloribus eveniet
        exercitationem fuga laboriosam magni mollitia necessitatibus odit praesentium, provident, quod rem
        reprehenderit sequi sit temporibus vero.
    </p>

@endsection
