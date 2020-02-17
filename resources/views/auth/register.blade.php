@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('auth.company_name') }}</label>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>

                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country_id" class="col-md-4 col-form-label text-md-right">Country</label>

                            <div class="col-md-6">
                                <select id="country_id" type="text" class="form-control @error('country_id') is-invalid @enderror" name="country_id" value="{{ old('country_id') }}" required autocomplete="country_id" autofocus>
                                    @foreach (\App\Models\Country::all() as $country)
                                        <option value="{{ $country->id }}"> {{ $country->name }}</option>
                                    @endforeach
                                </select>

                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city_id" class="col-md-4 col-form-label text-md-right">City</label>

                            <div class="col-md-6">
                                <select id="city_id" type="text" class="form-control @error('city_id') is-invalid @enderror" name="city_id" value="{{ old('city_id') }}" required autocomplete="city_id" autofocus>
                                    @foreach (\App\Models\City::all() as $city)
                                        <option value="{{ $city->id }}"> {{ $city->name }}</option>
                                    @endforeach
                                </select>

                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax_number" class="col-md-4 col-form-label text-md-right">Fax Number</label>

                            <div class="col-md-6">
                                <input id="fax_number" type="text" class="form-control @error('fax_number') is-invalid @enderror" name="fax_number" value="{{ old('fax_number') }}" required autocomplete="fax_number">

                                @error('fax_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">Website</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control" name="website" value="{{ old('website') }}" required >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="person_in_charge" class="col-md-4 col-form-label text-md-right">Person In Charge</label>

                            <div class="col-md-6">
                                <input id="person_in_charge" type="text" class="form-control @error('person_in_charge') is-invalid @enderror" name="person_in_charge" value="{{ old('person_in_charge') }}" required >
                                @error('person_in_charge')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="capital_of_enterprise" class="col-md-4 col-form-label text-md-right">Capital Of Enterprise</label>

                            <div class="col-md-6">
                                <input id="capital_of_enterprise" type="text" class="form-control @error('capital_of_enterprise') is-invalid @enderror" name="capital_of_enterprise" value="{{ old('capital_of_enterprise') }}" required >
                                @error('capital_of_enterprise')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ceiling_value" class="col-md-4 col-form-label text-md-right">Ceiling Value</label>

                            <div class="col-md-6">
                                <input id="ceiling_value" step="0.1" type="number" class="form-control @error('ceiling_value') is-invalid @enderror" name="ceiling_value" value="{{ old('ceiling_value') }}" required >
                                @error('ceiling_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>

                            <div class="col-md-6">
                                <select id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autofocus>
                                        <option value="Contractor">Contractor </option>
                                        <option value="Provider">Provider </option>
                                        <option value="Both">both </option>
                                </select>

                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="national" class="col-md-4 col-form-label text-md-right">National</label>

                            <div class="col-md-6">
                                <select id="national" type="text" class="form-control @error('national') is-invalid @enderror" name="national" value="{{ old('national') }}" required autofocus>
                                        <option value="0">Local </option>
                                        <option value="1">National </option>
                                </select>

                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
