<?php
    $sessionName = 'notifyer';
?>

@if (Session::has($sessionName . '.message'))
    @if (Session::has($sessionName . '.overlay'))
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get($sessionName . '.title'), 'body' => Session::get($sessionName . '.message')])
    @else
        <div class="alert alert-{{ Session::get($sessionName . '.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            {{ Session::get($sessionName . '.message') }}
        </div>
    @endif
@endif