<?php
    $sessionName = 'notifyer';
    $modalData   = [
        'modalClass' => 'flash-modal',
        'title' => session()->get($sessionName . '.title'),
        'body' => session()->get($sessionName . '.message')
    ];
?>

@if (session()->has($sessionName . '.message'))
    @if (session()->has($sessionName . '.overlay'))
        @include('notify::modal', $modalData)
    @else
        <div class="alert alert-{{ session()->get($sessionName . '.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            {{ session()->get($sessionName . '.message') }}
        </div>
    @endif
@endif