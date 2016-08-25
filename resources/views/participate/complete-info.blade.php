@extends('layouts.master')

@section('title', 'Participate - Complete information')

@section('content')
  <div id="participate-container">

    <div class="form-container">
      <h1 class="big">Complete your information</h1>

      <p>Please fill in your information to start uploading your photos.</p>

      {!! Form::model(\Auth::user(), ['route' => 'participate.complete-info.post']) !!}
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
        <label for="address">Address <span class="required" title="Required">*</span></label>
        {!! Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address', 'required']) !!}
        @if ($errors->has('address'))
          @foreach($errors->get('address') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('city') ? ' has-error' : '') }}">
        <label for="city">City <span class="required" title="Required">*</span></label>
        {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control', 'placeholder' => 'City', 'required']) !!}
        @if ($errors->has('city'))
          @foreach($errors->get('city') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('postcode') ? ' has-error' : '') }}">
        <label for="postcode">Postcode <span class="required" title="Required">*</span></label>
        {!! Form::text('postcode', null, ['id' => 'postcode', 'class' => 'form-control', 'placeholder' => 'Postcode', 'required']) !!}
        @if ($errors->has('postcode'))
          @foreach($errors->get('postcode') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>
      <div class="form-group{{ ($errors->has('country') ? ' has-error' : '') }}">
        <label for="country">Country <span class="required" title="Required">*</span></label>
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
        @if ($errors->has('country'))
          @foreach($errors->get('country') as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        @endif
      </div>

      <button type="submit" class="btn btn-default btn-submit">Save</button>
      {!! Form::close() !!}
    </div>
  </div>
@stop