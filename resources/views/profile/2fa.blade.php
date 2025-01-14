@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Two Factor Authentication (2FA)') }}</div>

          <div class="card-body">
            @if (session('status') == 'two-factor-authentication-enabled')
              <div class="alert alert-success" role="alert">
                Two Factor Authentication is enabled.
              </div>
            @endif
            @if (session('status') == 'two-factor-authentication-disabled')
              <div class="alert alert-warning" role="alert">
                Two Factor Authentication is disabled.
              </div>
            @endif

            <form action="/user/two-factor-authentication" method="POST">
              @csrf
              @if (auth()->user()->two_factor_secret)
                @method('DELETE')

                <div class="mb-5">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>

                <h4>Recovery Codes:</h4>
                <ul>
                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                        <li>{{ $code }}</li>
                    @endforeach
                </ul>

                <button class="btn btn-danger">Disable</button>
              @else
                <button class="btn btn-primary">Enable</button>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
