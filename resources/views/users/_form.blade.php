<?php

/**
 * @var \App\Models\User $user
 */
?>

<div class="form-group">
    <label>
        Name
    </label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
           value="{{ isset($user) ? $user->getName() : null}}">

    @error('name')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>
<div class="form-group">
    <label>
        Surname
    </label>
    {{--    <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $user->getSurname() ?: null}}" >--}}
    @include('users._input', ['name'=> 'surname', 'value' => isset($user) ? $user->getSurname() : null])
    @error('surname')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>
<div class="form-group">
    <label>
        Date of birth
    </label>
    <input type="text" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
           value="{{ isset($user) ? $user->getDateOfBirth()?->format('d-m-Y') : null}}">

    @error('date_of_birth')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>
<div class="form-group">
    <label>
        Email Address
    </label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
           value="{{ isset($user) ? $user->getEmail(): null}}">

    @error('email')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>
<div class="form-group">
    <label>
        Password
    </label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
           value="{{ isset($user) ? $user->getPassword() : null}}">

    @error('password')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>
