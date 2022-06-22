<section id="services" class="py-4"  >
    <div class="container">
        <ul class="row list-unstyled">
            @foreach($samples as $sample)
                <li class="col-sm-6 col-md-3">
                    <a href="{{ url($sample->slug) }}">
                        {{ \Illuminate\Support\Str::limit($sample->mtitle,30,'') }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
