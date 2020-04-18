<div class="input-field col s12">
	<p>{{ $field['label'] }}</p>
	<input type="hidden" name="{{ $field['name'] }}">
	<div class="quill" id="{{ $field['name'] }}"></div>
</div>

@push('js')
    <script>
    	$(function() {

			var {{ $field['name'] }} = new Quill('#{{ $field['name'] }}', {
				modules: {
					toolbar: toolbarOptions
				},
				theme: 'snow'
			});

			{{ $field['name'] }}.setContents({!! old($field['name'], \setting($field['name'])) !!});

			$('form').submit(function() {
				if ({{ $field['name'] }}.getText().trim().length != 0) {
					$('[name="{{ $field['name'] }}"]').val(JSON.stringify({{ $field['name'] }}.getContents()));
				}
			});

		});
    </script>
@endpush