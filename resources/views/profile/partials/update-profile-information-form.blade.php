<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="avatar" class="form-label">Foto Profil</label>
        <input id="avatar" name="avatar" type="file" accept="image/*" class="form-control @error('avatar') is-invalid @enderror">
        @error('avatar')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if($user->avatar)
            <div class="mt-2">
                <img src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar" class="rounded" style="height: 72px; width: 72px; object-fit: cover;">
            </div>
        @endif
    </div>

    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

        @if (session('status') === 'profile-updated')
            <span class="text-success small">{{ __('Saved.') }}</span>
        @endif
    </div>
</form>
