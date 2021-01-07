@extends('components.base')
@section('title', 'Home')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
@endpush

@section('content')
    @includeIf('components.menu_lateral')

    @includeIf('components.agenda.agenda')

    @includeIf('components.agenda.detalhes')
@endsection

@push('scripts')
    <script src="{{ asset('js/agenda.js') }}"></script>
    <script src="{{ asset('js/moment/moment.js') }}"></script>
@endpush
