@extends('layouts.app')

@prepend('style')
    <link rel="stylesheet" href="{{ mix('css/chat.css') }}">
@endprepend
@section('content')
    <div id="chat">
        <div class="container mt-3">
            <div class="row">

                <div class="col-md-8">
                    <div class="card bg-light">
                        <div class="card-header">
                            Chat
                        </div>
                        <div class="p-2" id="chat-panel">
                            <chat-messages :messages="messages"></chat-messages>
                        </div>
                        <div class="card-footer text-muted">
                            <chat-form
                                    v-on:messagesent="addMessage"
                                    :user="{{ auth()->user() }}"
                            ></chat-form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-header">
                            Users
                        </div>
                        <div class="p-1">
                            <chat-user></chat-user> {{-- :user="user" --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @prepend('scripts')
        <script src="{{ mix('js/chat.js') }}"></script>
    @endprepend
@endsection

