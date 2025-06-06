@extends('layouts.app')

@section('content')
  <div class="h-screen bg-gray-200 pt-100">
    <div class="container h-full flex flex-col">
      <form
        method="POST"
        action="{{ route('login') }}"
        class="w-2/3 bg-white rounded-lg shadow-lg p-50 mx-auto">
        @csrf
  
        <h1 class="text-24 text-center">Connexion à votre compte</h1>
  
        {{-- Email --}}
        <div class="mt-48">
          <label
            for="email"
            class="text-14 font-bold uppercase">
            Email
          </label>
          <input
            id="email"
            type="email"
            name="email"
            class="w-full bg-gray-200 rounded-lg outline-none focus:shadow-outline h-40 pl-20 mt-10"
            value="{{ old('email') ? old('email') : '' }}"
            required>
          @if ($errors->has('email'))
            <div
              class="text-12 text-red-400 mt-10"
              role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </div>
          @endif
        </div>
  
        {{-- Password --}}
        <div class="mt-48">
          <label
            for="password"
            class="text-14 font-bold uppercase">
            Mot de passe
          </label>
          <input
            id="password"
            type="password"
            name="password"
            class="w-full bg-gray-200 rounded-lg outline-none focus:shadow-outline h-40 pl-20 mt-10"
            required>
        </div>

        <input
          type="hidden"
          name="remember"
          checked>

        <button
          type="submit"
          class="bg-green-400 hover:bg-green-600 rounded-lg text-14 text-white font-bold uppercase px-20 py-10 mt-48">
          Connexion
        </button>
      </form>
    </div>
  </div>
@endsection
