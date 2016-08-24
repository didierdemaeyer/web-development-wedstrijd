@extends('layouts.master')

@section('title', 'Settings')

@section('content')
  <div id="settings-container" class="container">

    <div class="form-container">
      <h1 class="big">Settings</h1>

      {!! Form::model(\Auth::user(), ['route' => 'settings.post']) !!}
      <div class="form-group{{ ($errors->has('firstname') ? ' has-error' : '') }}">
        <label for="firstname">First name <span class="required" title="Required">*</span></label>
        {!! Form::text('firstname', null, ['id' => 'firstname', 'class' => 'form-control', 'placeholder' => 'First name', 'required']) !!}
        @if ($errors->has('firstname'))
          @foreach($errors->get('firstname') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('lastname') ? ' has-error' : '') }}">
        <label for="lastname">Last name <span class="required" title="Required">*</span></label>
        {!! Form::text('lastname', null, ['id' => 'lastname', 'class' => 'form-control', 'placeholder' => 'Last name', 'required']) !!}
        @if ($errors->has('lastname'))
          @foreach($errors->get('lastname') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('email') ? ' has-error' : '') }}">
        <label for="email">Email address <span class="required" title="Required">*</span></label>
        {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
        @if ($errors->has('email'))
          @foreach($errors->get('email') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('address') ? ' has-error' : '') }}">
        <label for="address">Address {!! session('required_info') == 'full' ? '<span class="required" title="Required">*</span>' : ''  !!}</label>
        @if(session('required_info') == 'full')
          {!! Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address', 'required']) !!}
        @else
          {!! Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address']) !!}
        @endif
        @if ($errors->has('address'))
          @foreach($errors->get('address') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('city') ? ' has-error' : '') }}">
        <label for="city">City {!! session('required_info') == 'full' ? '<span class="required" title="Required">*</span>' : ''  !!}</label>
        @if(session('required_info') == 'full')
          {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control', 'placeholder' => 'City', 'required']) !!}
        @else
          {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control', 'placeholder' => 'City']) !!}
        @endif
        @if ($errors->has('city'))
          @foreach($errors->get('city') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('postcode') ? ' has-error' : '') }}">
        <label for="postcode">Postcode {!! session('required_info') == 'full' ? '<span class="required" title="Required">*</span>' : ''  !!}</label>
        @if(session('required_info') == 'full')
          {!! Form::text('postcode', null, ['id' => 'postcode', 'class' => 'form-control', 'placeholder' => 'Postcode', 'required']) !!}
        @else
          {!! Form::text('postcode', null, ['id' => 'postcode', 'class' => 'form-control', 'placeholder' => 'Postcode']) !!}
        @endif
        @if ($errors->has('postcode'))
          @foreach($errors->get('postcode') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('country') ? ' has-error' : '') }}">
        <label for="country">Country {!! session('required_info') == 'full' ? '<span class="required" title="Required">*</span>' : ''  !!}</label>
        @if(session('required_info') == 'full')
          {!! Form::text('country', null, ['id' => 'country', 'class' => 'form-control', 'placeholder' => 'Country', 'required']) !!}
        @else
          {!! Form::text('country', null, ['id' => 'country', 'class' => 'form-control', 'placeholder' => 'Country']) !!}
        @endif
        @if ($errors->has('country'))
          @foreach($errors->get('country') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>

      <button type="submit" class="btn btn-default btn-submit">Save settings</button>
      {!! Form::close() !!}
    </div>
  </div>
@stop