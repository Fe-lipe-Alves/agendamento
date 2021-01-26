@extends('components.base')
@section('title', 'Home')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
@endpush

@section('content')
    @includeIf('components.menu_lateral')

    @includeIf('components.agenda.agenda')

    <div id="detalhes" class="col-12 col-md-3 border-left display-none">
{{--        @includeIf('components.agenda.detalhes')--}}
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/agenda.js') }}"></script>
    <script src="{{ asset('js/moment/moment.js') }}"></script>
@endpush
