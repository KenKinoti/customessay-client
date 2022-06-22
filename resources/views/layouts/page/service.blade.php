<section id="services" class="py-4 bg-services"  >
    <div class="container">
        <ul class="row list-unstyled">
            @foreach($services as $service)
                <li class="col-sm-6 col-md-3">
                    <a href="{{ url($service->slug) }}">
                        {{ \Illuminate\Support\Str::limit($service->mtitle,30,'') }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
