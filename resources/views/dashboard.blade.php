@extends('layouts.app') <!-- Anda dapat mengubah layout sesuai dengan struktur tampilan Anda -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <p>Hallo, {{ Auth::user()->name }}!</p>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">{{ __('Logout') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
