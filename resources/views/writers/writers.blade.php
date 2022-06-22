@extends('layouts.page')

@section('title','Top-Rated and Reliable Homework Help Experts')

@section('meta')
<meta name="title" content="Meet the Best Assignment Writers Online"/>
<meta name="keywords" content="professional homework experts, ivy-league assignments, top-quality homework writing, expert tutoring, best assignment writers, high-quality homework helpers, professional academic experts, professional writers"/>
<meta name="description" content="Here are the best assignment help experts worldwide. All our homework help writers go through rigorous application processes to make sure that they deliver high-quality assignments.."/> 
<meta name="robots" content="index, follow" />
<link rel="canonical" href=" https://mycustomessays.com/writers" />
<meta name="twitter:title" content="Meet the Best Assignment Writers Online"/>
<meta name="twitter:description" content="Here are the best assignment help experts worldwide. All our homework help writers go through rigorous application processes to make sure that they deliver high-quality assignments.."/>
<meta name="twitter:card" content="Summary" />
<meta name="twitter:image" content=" https://mycustomessays.com/images/writers.jpg"/>
<meta name="twitter:url" content="https://mycustomessays.com"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
<meta property="og:title" content="Meet the Best Assignment Writers Online"/>
<meta property="og:description" content="Here are the best assignment help experts worldwide. All our homework help writers go through rigorous application processes to make sure that they deliver high-quality assignments.."/>
<meta property="og:url" content="https://mycustomessays.com/writers"/>
<meta property="article:section" content="Meet the Best Assignment Writers Online "/>
<meta property="og:image" content="https://mycustomessays.com/images/writers.jpg" />   
<meta property="og:image:secure_url" content="https://mycustomessays.com/images/writers.jpg" />
<meta property="og:image:type" content="image/jpg" />
<meta property="og:image:alt" content=" Meet the Best Assignment Writers Online "/>
@stop

@section('page')
    <section class="py-5">
        <div class="container">
            <h1 class="text-center">{{ __('Our Writers') }}</h1>
            <div class="row">
                <div class="col-sm-12 ">
                    <p>{{ __('We have over two hundred active writers selected through a very rigorous vetting process. Our
                        writers are all Masters and PhD degree holders with not less than three years of academic
                        writing experience. We do not hire bachelor level writers.') }}</p>
                    <p>{{ __('At Mycustomessays.com, diversity
                        is our strength. Our writers come from different countries and specialize in various academic
                        subjects. Our writers are proficient in more than 50 disciplines for high school, undergraduate,
                        and postgraduate education.') }}</p>
                    <p>{{ __('Moreover, we subject all applicants to rigorous English
                        proficiency tests and subject-specific tests to gauge their skills level before bringing them
                        onboard. Thus, you can rest assured that your paper is in the hands of the very best in the
                        industry.') }}</p>
                    <p>{{ __('Our goal is to produce academic papers that are well researched, professionally
                        written, and proficiently structured. Once you place an order, it’s assigned to the most
                        qualified writer in your field of study. Order today and become a part of our success story!') }}</p>
                </div>
            </div>
        </div>
    </section>
    <section id="writerList" class="bg-light py-5 position-relative" >
        <div class="container">
            <div class="my-2">
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <select name="discipline" id="discipline" class="form-control">
                            <option value="">{{ __('Select Discipline') }}</option>
                            @foreach($disciplines as $discipline)
                                <option value="{{ $discipline->id }}">{{ $discipline->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="writerRating" id="writerRating" class="form-control">
                            <option value="">{{ __('Select Rating') }}</option>
                            @for($i = 1; $i<=5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="orders" id="orders" class="form-control">
                            <option value="">{{ __('Completed Orders') }}</option>
                            <option value="50-100">50 - 100</option>
                            <option value="101-500">101 - 500</option>
                            <option value="501-1000">501 - 1000</option>
                            <option value="1001-3000">1001 - 3000</option>
                            <option value="3000">3000+</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive ">
                <table id="writerListTable" class="table table-striped">
                    <thead>
                    <tr class="bg-primary text-white">
                        <th class="text-center border-right border-light w-50" >{{ __('Expert Profile') }}</th>
                        <th class="text-center border-right border-light">{{ __('Client Rating') }}</th>
                        <th class="text-center border-right border-light">{{ __('Completed Orders') }}</th>
                        <th class="text-center">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>

    @include('pages.partials.steps')
@endsection
