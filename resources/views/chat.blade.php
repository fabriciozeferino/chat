@extends('layouts.app')

@section('content')
    <div class="container">
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
        </div>
    </div>
@endsection
