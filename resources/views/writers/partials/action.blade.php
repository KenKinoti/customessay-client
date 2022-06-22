<form method="post" action="{{ route('potential') }}">
    @csrf
    <input type="hidden" name="writer" value="{{ $writer->id }}">
    <button type="submit" class="btn btn-warning btn-rounded m-0">
        Hire Me
    </button>
</form>
