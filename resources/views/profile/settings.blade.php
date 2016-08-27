@extends('layouts.master')

@section('title', 'Settings')

@section('content')
  <div id="settings-container">

    <div class="form-container">
      <h1 class="big">Personal information</h1>

      {!! Form::model(\Auth::user(), ['route' => 'settings.information.post']) !!}
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
      <div class="form-group{{ ($errors->has('country') ? ' has-error' : '') }}">
        <label for="country">Country {!! session('required_info') == 'full' ? '<span class="required" title="Required">*</span>' : ''  !!}</label>
        @if(session('required_info') == 'full')
          <select name="country" id="country" class="form-control" required>
            <option value="" disabled selected>Select your country</option>
            @foreach($countries as $country)
              @if (\Auth::user()->country_id == $country->id)
                <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
              @else
                <option value="{{ $country->id }}">{{ $country->name }}</option>
              @endif
            @endforeach
          </select>
        @else
          <select name="country" id="country" class="form-control">
            <option value="" disabled selected>Select your country</option>
            @foreach($countries as $country)
              @if (\Auth::user()->country_id == $country->id)
                <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
              @else
                <option value="{{ $country->id }}">{{ $country->name }}</option>
              @endif
            @endforeach
          </select>
        @endif
        @if ($errors->has('country'))
          @foreach($errors->get('country') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>

      <button type="submit" class="btn btn-default btn-submit">Update information</button>
      {!! Form::close() !!}
    </div>

    <div class="form-container">

      @if(\Auth::user()->getAuthPassword())
        <h1 class="big">Change password</h1>
      @else
        <h1 class="big">Set password</h1>

        <p>Set a password here to be able to log in with both your email/password combination and your social account.</p>
      @endif

      {!! Form::model(\Auth::user(), ['route' => 'settings.password.post']) !!}

      @if(\Auth::user()->getAuthPassword())
        <div class="form-group{{ ($errors->has('old_password') ? ' has-error' : '') }}">
          <label for="old_password">Old password <span class="required" title="Required">*</span></label>
          {!! Form::password('old_password', ['id' => 'old_password', 'class' => 'form-control', 'placeholder' => 'Old password', 'required']) !!}
          @if ($errors->has('old_password'))
            @foreach($errors->get('old_password') as $error)
              <p class="error">{{ $error }}</p>
            @endforeach
          @endif
        </div>
      @endif
      <div class="form-group{{ ($errors->has('new_password') ? ' has-error' : '') }}">
        <label for="new_password">New password <span class="required" title="Required">*</span></label>
        {!! Form::password('new_password', ['id' => 'new_password', 'class' => 'form-control', 'placeholder' => 'New password', 'required']) !!}
        @if ($errors->has('new_password'))
          @foreach($errors->get('new_password') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('confirm_new_password') ? ' has-error' : '') }}">
        <label for="confirm_new_password">Confirm new password <span class="required" title="Required">*</span></label>
        {!! Form::password('confirm_new_password', ['id' => 'confirm_new_password', 'class' => 'form-control', 'placeholder' => 'Confirm new password', 'required']) !!}
        @if ($errors->has('confirm_new_password'))
          @foreach($errors->get('confirm_new_password') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>

      @if(\Auth::user()->getAuthPassword())
        <button type="submit" class="btn btn-default btn-submit">Change password</button>
      @else
        <button type="submit" class="btn btn-default btn-submit">Set password</button>
      @endif
      {!! Form::close() !!}
    </div>
  </div>
@stop