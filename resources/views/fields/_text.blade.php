<div class="input-field col s12 l6 {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
    <input type="{{ $field['type'] }}"
           name="{{ $field['name'] }}"
           value="{{ old($field['name'], \setting($field['name'])) }}"
           class="validate {{ array_get( $field, 'class') }}"
           id="{{ $field['name'] }}">
    @if ($field['desc'])
		<p class="input-desc">{{ $field['desc'] }}</p>
	@endif
</div>