@extends('layouts.app')

@section('content')
    <x-userMenu>
        <div class="d-flex justify-content-center">
            <h2>Account</h2>
        </div>
        <hr>
        <div class="card mb-1">
            <div class="card-body">
                <strong>Informatie</strong>
                {!! Form::open(['action' => ['App\Http\Controllers\AccountController@updateUser'], 'method' => 'POST']) !!}
                    <div class="row col-sm-12 col-lg-6">
                        <div class="col-sm-12 col-lg-4">
                            <label style="margin-top:5px;font-size:16px">Naam</label>
                        </div>
                        <div class="col-sm-12 col-lg-8">
                            {{ Form::text('name', $gebruiker->name, ['id'=>'name','class'=>'form-control','disabled']) }}
                        </div>
                    </div>
                    <br>
                    <div class="row col-sm-12 col-lg-6">
                        <div class="col-sm-12 col-lg-4">
                            <label style="margin-top:5px;font-size:16px">Email</label>
                        </div>
                        <div class="col-sm-12 col-lg-8">
                            {{ Form::email('email', $gebruiker->email, ['id'=>'email','class'=>'form-control','disabled']) }}
                        </div>
                    </div>
                    @if ($gebruiker->role_id != 2)
                        
                    @else
                    <div id="roleDiv">
                        <br>
                        <div class="row col-sm-12 col-lg-6">
                            <div class="col-sm-12 col-lg-4">
                                <label style="margin-top:5px;font-size:16px">Role</label>
                            </div>
                            <div class="col-sm-12 col-lg-8">
                                {{ Form::text('role', 'Admin', ['class'=>'form-control','disabled']) }}
                            </div>
                        </div>
                    </div>
                    @endif
                    <br>
                    <div class="row col-sm-12 col-lg-6">
                        <div class="col-sm-12 col-lg-4">
                        </div>
                        <div class="col-sm-12 col-lg-8">
                            <button type="button" id="edit" class="btn btn-success" onclick="event.preventDefault();changeNaarEditUser()"><i class="fa-solid fa-pen"></i></button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row col-sm-12 col-lg-7">
                    <strong>Verander wachtwoord</strong>
                    <br>
                    <div class="row col-sm-12 col-lg-4">
                        <a id="passwordDiv" style="display:none;" href="/password/reset">Nieuw wachtwoord</a>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <button id="editPassword" class="btn btn-success" onclick="event.preventDefault();changeNaarEditPasswordShow()"><i class="fa-solid fa-pen"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </x-userMenu>
    <script>
        function changeNaarEditUser(){
            $('#name').prop('disabled', false);
            $('#email').prop('disabled', false);
            $('#roleDiv').hide();
            
            $('#edit').removeAttr('onclick');
            $('#edit').attr({
                type: 'submit',
                class: 'btn btn-primary'
            });
        }
        function changeNaarEditPasswordShow(){
            $('#passwordDiv').show();
            $('#editPassword').attr({
                onclick: 'event.preventDefault();changeNaarEditPasswordHide()',
                class: 'btn btn-primary'
            });
        }
        function changeNaarEditPasswordHide(){
            $('#passwordDiv').hide();
            $('#editPassword').attr({
                onclick: 'event.preventDefault();changeNaarEditPasswordShow()',
                class: 'btn btn-success'
            });
        }
    </script>
@endsection