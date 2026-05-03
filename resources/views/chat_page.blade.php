@extends('pharma.home')

@section('content')
    @livewireStyles
    <div class="container mt-4">
        @livewire('chat')
    </div>
    @livewireScripts
@endsection