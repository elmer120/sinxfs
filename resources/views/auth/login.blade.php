@extends('layouts.app')

<div class="uk-grid-small" uk-grid> <!-- inizio griglia small gutter-->

    <div class="uk-width-1-4"> 
    </div>


    <div class="uk-width-1-2"> 
    <img class="uk-background-contain uk-background-center-center" src="<? // echo base_url("assets/img/login_background.svg");?>" alt="Sinx"/>
        <div class="uk-container uk-position-center">
            <div class="uk-card uk-card-default ">
                <div class="uk-card-badge uk-label uk-text-lowercase"><? //php echo lang('version');?></div>
                <div class="uk-card-media-top">
                    <img class="uk-height-small uk-height-max-small" src="<? // echo base_url("assets/img/logo.png");?>" alt="Sinx"/>
                </div>
                <div class="uk-card-body">
                <form class="uk-form-horizontal" method="POST" action="{{ route('login') }}">
                            @csrf

                    <label class="uk-form-label">Username</label>

                    <div class="uk-form-controls uk-margin">
                        <input class="uk-input uk-form-width-medium {{ $errors->has('username') ? ' uk-form-danger' : '' }}" 
                        type="text" name="username" value="{{ old('username') }}" required autofocus/>
                        
                        @if ($errors->has('username'))   
                                    <strong>{{ $errors->first('username') }}</strong>
                        @endif
                    </div>
                            
                    
                        <label class="uk-form-label">Password</label>

                    <div class="uk-form-controls uk-margin">
                        <input class="uk-input uk-form-width-medium {{ $errors->has('password') ? ' uk-form-danger' : '' }}"
                        type="password" name="password" value="" required>

                        @if ($errors->has('password'))
                                    <strong>{{ $errors->first('password') }}</strong>
                            @endif
                    </div>
                            

                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                        <label>
                            <input class="uk-checkbox" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                        
                    <input  class="uk-button uk-button-default uk-width-1-1" type="submit" name="submit" value="Accedi" />
                </form>
                </div>
                
            </div>
            
        </div>
    </div>


    <div class="uk-width-1-4"> 
    </div>

</div>