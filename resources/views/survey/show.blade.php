@extends('layouts.app')
@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    설문지
                </div>
                <div class="card-body">
                    <div id="survey-form" data-survey-id="{{$id}}" data-locale="{{app()->getLocale()}}"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
