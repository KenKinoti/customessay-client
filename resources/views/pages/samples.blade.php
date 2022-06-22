    <section class="py-3">
        <div class="container">
            <h2 class="text-center"> {{ __('Check out our free samples') }}</h2>

          
            <div class="row align-items-baseline mt-3">
                @forelse($samples as $sample)
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="blog-box shadow-lg rounded" >
                         
                            <div class="single-blog bg-primary" >                           
                                    <a href="{{ url('blog',$sample->slug)}}">
                                        <h3 class="card-title text-white">{!! \Illuminate\Support\Str::limit(strip_tags($sample->paperType->name),'22','...') !!}</h3>
                                    </a>                            
                            </div>

                                <div class="single-blog">
                                    <p><strong class="sample-color" >Paper Title</strong>: {!! \Illuminate\Support\Str::limit(strip_tags($sample->title),'25','....') !!}</p>
                                    <p><strong class="sample-color" >Discipline</strong>: {{ $sample->discipline->name }}</p>
                                   
                                    <p><strong class="sample-color">Academic Level</strong>: {{ $sample->academicLevel->name }}</p>
                                     <p><strong class="sample-color">Pages</strong>: {{ $sample->pages }}</p>

                                    
                                    
                                    <p>{!! \Illuminate\Support\Str::limit(strip_tags($sample->content),'180','....') !!}</p>
                                    <button class="sample-button">
                          <a class="nav-link" href="{{ url('samples',$sample->slug)}}" ><span class="pb_rounded-4 px-4 text-black" > View Sample  <i class="ti ti-arrow-right text-primary" ></i></span></a></button>
                                </div>
                            </div>
                        </div>
              
                @empty
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i> {{ __('No samples at the moment.') }}
                    </div>
                @endforelse
            </div>
        </div>
        </div>
    </section>