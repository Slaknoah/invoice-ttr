<div class="input-field col s12 l6">
	<select name="{{ $field['name'] }}">
		@foreach(array_get($field, 'options', []) as $val => $label)
        	<option @if (old($field['name'], \setting($field['name'])) == $val) selected @endif value="{{ $val }}">{{ $label }}</option>
    	@endforeach
    </select>
    <label>{{ $field['label'] }}</label>
</div>