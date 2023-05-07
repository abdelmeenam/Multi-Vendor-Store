<div class="form-group">
    <x-form.input label="Role Name" class="form-control-lg" role="input" name="name" :value="$role->name" />
</div>

<fieldset>
    <legend>{{ __('abilities') }}</legend>

    @foreach (config('abilities') as $abilityCode => $abilityName)
        <div class="row mb-2">

            <div class="col-md-6">
                {{ $abilityName }}
            </div>

            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $abilityCode }}]" value="allow" @checked(($roleAbilities[$abilityCode] ?? '') == 'allow')>
                Allow
            </div>

            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $abilityCode }}]" value="deny" @checked(($roleAbilities[$abilityCode] ?? '') == 'deny')>
                Deny
            </div>

            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $abilityCode }}]" value="inherit"
                    @checked(($roleAbilities[$abilityCode] ?? '') == 'inherit')>
                Inherit
            </div>

        </div>
    @endforeach
</fieldset>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
