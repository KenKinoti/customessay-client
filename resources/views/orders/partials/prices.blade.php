@push('scripts')
    <script>
        (function () {window.prices = {@foreach($pricing['prices'] as $price)"{{ $price->type }}L{{ $price->academic_level_id }}D{{ $price->deadline_id }}": "{{ $price->price }}",@endforeach}})();
    </script>
@endpush
