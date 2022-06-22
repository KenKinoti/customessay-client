@extends('layouts.page')
@section('title', "Quality Essays from the Best Essay Writing Service Platform
")
@section('meta')
<meta name="title" content="High-Quality Essay Writing Service"/>
<meta name="keywords" content="quality essays, professional essay, essay writer, professional essay writer, flawless essay writing, essay editing, essay assignments, essay writing services"/>
<meta name="description" content="Need help with essay writing? Get essay writing services from the best online essay writers."/> 
<meta name="robots" content="index, follow" />
<link rel="canonical" href="https://mycustomessays.com" />
<meta name="twitter:title" content="Get Quality Essays"/>
<meta name="twitter:description" content="Need help with essay writing? Get essay writing services from the best online essay writers."/>
<meta name="twitter:card" content="Summary" />
<meta name="twitter:image" content=" https://mycustomessays.com/images/best-custom-essay.jpg"/>
<meta name="twitter:url" content="https://mycustomessays.com"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
<meta property="og:title" content="Get Quality Essays"/>
<meta property="og:description" content="Need help with essay writing? Get essay writing services from the best online essay writers."/>
<meta property="og:url" content="https://mycustomessays.com"/>
<meta property="article:section" content="World's Best Custom Essay Writing Service "/>
<meta property="og:image" content="https://mycustomessays.com/images/best-custom-essay.jpg" />   
<meta property="og:image:secure_url" content="https://mycustomessays.com/images/best-custom-essayy.jpg" />
<meta property="og:image:type" content="image/jpg" />
<meta property="og:image:alt" content=" Get Quality Essays "/>
@endsection



@section('page')
    <section class=" py-5  banner-back">

        <div class="container">
            <div class="row margin-rem" >
                <div class="col-md-6">
                    <h1 class=" text-white  mt ml-0 mt-4  font-weight-bold font-rem3" >{{ __('Is your Assignment      giving you too much stress?') }}</h1>
                    <h2 class="text-white mt-3 text-center">{{ __("Get Instant Help from the World's best Custom Essay Writing Service.") }}</h4>

                    <div class="d-block">

                        <button class=" btn btn-secondary rounded  text-center mt-5"><a class="text-white" href="{{url('/order')}}">
                            <h3 class="text-white font-weight-bold">{{ __('Place Order') }} </h3></a></button>

                        <button class=" btn btn-primary rounded text-center mt-5 bordersolid" ><a
                                class="text-white" href="{{ route('enquiry.create') }}"><h3
                                    class="text-white font-weight-bold">{{ __('Free Inquiry') }} </h3>
                            </a></button>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container bg-white">
            <h2 class=" text-center"><span></span>{{ __('Why choose us?') }} </h2>
            <div class="row mt-3 mb-5">
                <div class="col-md-3">
                    <div class="blocky  h-100 mt-2">
                        <img src="{{ asset('images/first.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">{{ __('Experienced Writers') }} </h4>
                        <p class=" mr-2 mx-2">{{ __('Our team of writers consists of English speakers from the UK, US, Canada, and Hong Kong. We do not hire bachelor level writers. All our writers are Masters and Ph.D. degree holders and are continuously tested and peer-reviewed to ensure consistent services in line with our quality guarantee policy.') }}  </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="blocky mt-2 h-100">
                        <img src="{{ asset('images/plagiarism.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">{{ __('Plagiarism-Free Papers ') }} </h4>
                        <p class=" mr-2 mx-2">{{ __('No plagiarism! Our writers don’t plagiarize or reuse papers. We run every paper submitted to us through our state-of-the-art plagiarism checker to ensure we deliver quality, plagiarism-free papers that can’t be traced anywhere online.') }}  </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="blocky mt-2  h-100">
                        <img src="{{ asset('images/time.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">{{ __('On-Time Delivery ') }} </h4>
                        <p class=" mr-2 mx-2">{{ __('Don’t let a tight deadline scare you. We have a team of writers from all the major time zones so we can guarantee you’ll get your paper when you need it. We understand that your deadline is critical. So, we strive to deliver the work within the stipulated time window.') }}  </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="blocky mt-2 h-100">
                        <img src="{{ asset('images/support.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">{{ __('24 Hours Customer Support') }} </h4>
                        <p class=" mr-2 mx-2">{{ __('We have a team of friendly customer support staff who work around the clock to ensure all our customers’ queries are resolved on time. Our Live Chat support is also available 24/7 so you can reach us at any time—day or night regardless of time zones.') }} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <section class="py-5">
        <div class="container">
             <h2 class="text-center">{{ __('Essay Writing Service Features That Matter ') }}</h2>

            <p class="text-center">{{ __('The human mind is programmed to opt for the tasks that require minimal effort to execute, and studying ain’t one of them. Let’s face it! Between watching Netflix and calculating derivatives in Calculus, which one would you choose? The majority if not all people would opt for the former. The same goes for scholarly work. ') }}</p>
            <p class="text-center">{{ __('Academic writing assignments require a lot of time, effort, and attention to produce outstanding content. But since many students experience challenges in handling some of the complex topics, they often look for essay writing companies that can lift the burden off their shoulders.With professional assistance from a reliable essay writing company, you can get the grades you need with little to no effort. But with so many essay writing companies out there, it can be hard to spot a unicorn in a field of horses. ') }}</p>
            <p class="text-center">{{ __('With our custom essay writing service, every paper we produce is unique, 100% original, and tailored to your specific needs. Here are the key essay writing features that make our service stand out from the competition. ') }}</p>  
              <div class="row">
                    <div class="col-md-6 mt-2">
                        <div class="card h-100 shadow-lg mt-2 ">
                        <h4  class="mx-2 mr-2">{{ __('Top-Grade Security ') }}</h4>
                        <p  class="mx-2 mr-2">{{ __('In an age of cybersecurity threats and online frauds, website security is critical.  A secure website not only protects your customers by safeguarding their confidential information but also boosts your company’s reputation.At mycustomessays.com, we take security seriously. Our website uses military-grade encryption to safeguard sensitive customer data such as credit card details. We also use trusted cyber-security software that allows us to detect potential vulnerabilities and protect you from threats and online fraud. Moreover, we do not share any information with pesky ad agencies or academic institutions.
                         ') }}</p>
                     </div>
                 </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="card h-100 shadow-lg mt-2 ">

                        <h4  class="mx-2 mr-2">{{ __('Competitive Pricing ') }}</h4>
                        <p  class="mx-2 mr-2">{{ __('Pricing is an important factor to consider when choosing a custom essay writing company. The price a company charges should give you insights into what to expect with the service. Some companies are on the upper end—charging a whopping $80+ per page. Others go cheap—charging less than $30 per page to gain more customers.At Mycustomessays.com, we try to be reasonable with pricing and have hit the sweet spot at $40 per page. This way, we’re able to compensate our writers fairly without hitting the customer hard. Moreover, we offer coupons and discounts from time to time to our loyal customers. ') }}</p>
                    </div>
                </div>
                               <div class="col-md-6 mt-2">
                                <div class="card h-100 shadow-lg mt-2 ">

                        <h4  class="mx-2 mr-2">{{ __('Quality Guarantee ') }}</h4>
                        <p  class="mx-2 mr-2">{{ __('The quality of work that a writing agency delivers is what sets it apart from the competition. That’s why many students prefer to pay more for quality work than pay less and get mediocre services. As a leading essay writing company, we strive to produce papers that meet our customers’ expectations. Our Quality Assurance team checks all the work for quality, originality, and relevancy to ensure the work delivered is nothing less than perfect.  ') }}</p>
                    </div>
                </div>
                               <div class="col-md-6 mt-2">
                                <div class="card h-100 shadow-lg mt-2 ">


                        <h4  class="mx-2 mr-2">{{ __('Unlimited Revisions Policy ') }}</h4>
                        <p  class="mx-2 mr-2">{{ __('A great online essay writing company should have a revision policy that allows the students to request as many revisions as possible. Keep in mind that revisions may not have anything to do with quality or grammatical anomalies. Even if a paper was written by a Harvard graduate, chances are that it might not meet your content standards. At times, the writer may overlook some concepts or have a different opinion from what you had in mind.In such cases, students have the right to request edits or a change of opinion. At Mycustomessays.com, we have an unlimited revisions policy that we abide by. Our dashboard allows you to chat with your writer and request as many edits as possible.  ') }}</p>
                    </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="card h-100 shadow-lg mt-2 ">
                        <h4  class="mx-2 mr-2">{{ __('Excellent Support Services ') }}</h4>
                        <p  class="mx-2 mr-2">{{ __('An essay writing company that delivers great content but offers poor support services will not survive for long in the ever-competitive online business world. Why? According to Oberlo, more than 90% of customers will stop buying from a company after three poor customer service experiences. At Mycustomessays.com, excellent customer service is the forte of our business. We provide various means for our customers to reach us. You can email your queries to us and we’ll respond within 24 hours or call us directly via our toll-free number. Moreover, our Chat services are available 24/7 so you can chat with our support staff at any time—day or night.   ') }}</p> 
                    </div>
                </div>
                               <div class="col-md-6 mt-2">
                                <div class="card h-100 shadow-lg mt-2 ">


                        <h4  class="mx-2 mr-2">{{ __(' Receive work on time ') }}</h4>
                        <p  class="mx-2 mr-2">{{ __('The very nature of the essay writing business requires companies to give precedence to quality and on-time delivery. Nothing else is more important than this when it comes to meeting customer expectations. Why? A missed deadline can have dire consequences on the student as well as impact your business reputation negatively. Our business model is built on the premise of on-time delivery. To achieve this, we have recruited writers from virtually all time zones, so our writers are always on standby, ready to scoop even that 8-hour deadline task at any time—day or night.  ') }}</p>
                    </div>
                </div>
                               <div class="col-md-6 mt-2">
                                <div class="card h-100 shadow-lg mt-2 ">

                         <h4  class="mx-2 mr-2">{{ __('Plagiarism Checks ') }}</h4>
                        <p  class="mx-2 mr-2">{{ __('Plagiarism is an abomination in the online essay writing domain. There is no better way to damage your company’s reputation than to produce plagiarized content. The best essay writing companies use specialized plagiarism software to scan all work for plagiarism. At Mycustomessays.com, we have zero-tolerance for plagiarism. We run all content through a sophisticated plagiarism checker to ensure the content submitted by our writers is clean, 100% plagiarism free and can’t be traced anywhere online—unless you publish it yourself.  ') }}</p> 
                    </div>
                </div>
                    <div class="col-md-6 mt-2">
                        <div class="card h-100 shadow-lg mt-2 ">
                            
                        <h4 class="mx-2 mr-2">{{ __('Moneyback Guarantee ') }}</h4>
                        <p class="mx-2 mr-2">{{ __('The best essay writing companies will have a moneyback guarantee clause to provide additional security and assurance of quality. This clause should dictate the circumstances under which the moneyback guarantee policy will take effect as well as how long it will take for the customer to get a refund. We promise a 100% moneyback guarantee within 7 days in the event the customer is not satisfied with the quality of the work produced. Now that you know what you’ll get if you choose to work with us, why not give our essay writing service a try? Order Today and experience what it feels like to work with professionals!  ') }}</p>
                        </div>

                    </div>



                </div>
        </div>
    </section>
    <section class="py-5 bg-light bg-fade">
        <div class="container ">
            <h2 class=" text-center"><span></span>{{ __('How it works') }}</h2>
            <div class="row mt-3 mb-5">
                <div class="col-md-3">
                    <div class="  h-100">
                        <img src="{{ asset('images/one.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">{{ __('Give Instructions') }} </h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="  h-100">
                        <img src="{{ asset('images/two.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">{{ __('Writer Assigned') }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="  h-100">
                        <img src="{{ asset('images/three.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">{{ __('Track Order Progress') }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class=" h-100">
                        <img src="{{ asset('images/four.png') }}" alt="research-writing-services"
                             class="img-responsive mx-auto d-block mt-2">
                        <h4 class="text-center">{{ __('Download your paper') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    <section class="py-5">
        <div class="container">
            <h2 class="text-center">{{ __('Check pricing for your order') }} </h2>
            <div class="row">
                <div class="col-md-8 ">
                    <div class="overflow-auto">

                        @include('pages.price')
                    </div>
                </div>
                <div class="col-md-4 shadow ">
                    <h2>{{ __(' Free Features') }}
                    </h2>
                        <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Free title Page') }}</p>
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Free bibliography Page') }}</p>
                  
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Free Formatting (APA, MLA, Harvard, Chicago/Turabian) ') }}</p>

                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Free Unlimited Revisions') }}</p>
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Free 24 Hours Customer Support') }}
                    </p>

                </div>
            </div>
        </div>
    </section>
      <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                     @include('orders.partials.page_calculator')
                </div>
            </div>
        </div>
    </section>

    @include('pages.partials.steps')

    <section class="py-5 bg-white">
        <div class="container ">
            <h3 class="text-center"> {{ __('Additional special features') }}</h3>
            <p class="text-center">{{ __('Add more value to your paper with these additional special features') }}</p>
            <div class="row mt-3 mb-5">
                <div class="col-md-6 row">

                    <div class="col-md-2">
                        <img src="{{ asset('images/service.png') }}" alt="research-writing-services"
                             class="img-fluid mx-auto d-block ">
                    </div>
                    <div class="col-md-10 mt-2">
                        <h4>{{ __('Advanced writer option') }}</h4>
                    </div>


                    <div class="col-md-2">
                        <img src="{{ asset('images/service.png') }}" alt="research-writing-services"
                             class="img-fluid mx-auto d-block">
                    </div>
                    <div class="col-md-10 mt-2">
                        <h4>{{ __('Charts and Slides') }}</h4>
                       
                    </div>


                    <div class="col-md-2">
                        <img src="{{ asset('images/service.png') }}" alt="research-writing-services"
                             class="img-fluid mx-auto d-block">
                    </div>
                    <div class="col-md-10 mt-2">
                        <h4>{{ __(' Preferred Writer') }}</h4>
                       
                    </div>

                </div>
                <div class="col-md-6 row">
                    <div class="col-md-2">
                        <img src="{{ asset('images/service.png') }}" alt="research-writing-services"
                             class="img-fluid mx-auto d-block">
                    </div>
                    <div class="col-md-10 mt-2">
                        <h4>{{ __('Copy of Digital Sources') }}</h4>
                    </div>

                    <div class="col-md-2">
                        <img src="{{ asset('images/service.png') }}" alt="research-writing-services"
                             class="img-fluid mx-auto d-block">
                    </div>
                    <div class="col-md-10 mt-2">
                        <h4>{{ __('Plagiarism Report') }}</h4>
                    </div>
                    <div class="col-md-2">
                        <img src="{{ asset('images/service.png') }}" alt="research-writing-services"
                             class="img-fluid mx-auto d-block">
                    </div>
                    <div class="col-md-10 mt-2">
                        <h4 class="mt-2">{{ __('Grammar Report ') }}</h4>
                       
                    </div>

                </div>


            </div>
        </div>
    </section>
    @include('pages.samples')


    <section class="py-5 bg-light bg-fade">
        <div class="container ">
            <h3 class=" text-center">{{ __('We cover the following service areas and disciplines') }}</h3>
            <div class="row mt-3 mb-5">

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Custom Essays Writing') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Assignment Writing') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Nursing Writing') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Programming Writing ') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Homework help ') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Coursework help') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Powerpoint presentation') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Editing Proofreading ') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Dissertation writing ') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Research paper writing ') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Thesis paper writing ') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Business writing') }}</p>
                </div>
                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Term paper writing') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Speech writing') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Research proposal') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Research proposal writing') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Movie  review writing  ') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Literature review writing') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Article review  writing') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Grant proposal writing ') }}</p>
                </div>

                   <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Essay writing') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Data analysis ') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Data analysis help ') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Critical thinking ') }}</p>
                </div>

                 <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Creative writing') }}</p>
                </div>

                <div class="col-md-3">
                    <p><i class="ti ti-check-box text-primary" aria-hidden="true"> </i>{{ __('Case study writing') }}</p>
                </div>





            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container ">
            <div class="row mt-3 mb-5">
                <div class="col-md-12">
                    <img src="{{ asset('images/features.PNG') }}" alt="research-writing-services"
                         class="img-fluid mx-auto d-block mt-2">

                </div>

            </div>
        </div>
    </section>
    <section class="py-5 mt-2 bg-light">
        <div class="container">
            <div class="text-center pb-3">
                <h3 class="section-title">{{ __('What our customers say about Us') }}</h3>
            </div>
            <div class="overflow-hidden">
                @include('pages.components.reviews')
            </div>
        </div>
    </section>

    <section id="faq" class="faq  py-5">
        <div class="container">
            <h3 class="text-center">{{ __('Frequently asked questions') }}</h3>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="heading-2">
                        <a class="d-block" href="#" data-toggle="collapse" data-target="#collapse-2"
                           aria-expanded="false" aria-controls="collapseOne">{{ __('What is MyCystomessays.com?') }}
                        </a>
                    </div>

                    <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{ __('Mycustomessays.com is a leading essay writing company that provides writing assistance to students and businesses alike. We pride ourselves on our ability to deliver quality, well-researched academic papers from virtually any discipline.') }}</p>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="heading-4">
                        <a class="d-block" href="#" data-toggle="collapse" data-target="#collapse-4"
                           aria-expanded="false" aria-controls="collapseOne">{{ __('Is Mycustomessays.com Legit?') }}
                        </a>
                    </div>

                    <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion">
                        <div class="card-body">
                           <p>{{ __('Mycustomessays.com is perfectly legit. We’ve received positive reviews from popular review sites like Sitejabber. We have also been featured on Huffington Post, Yahoo, and Business Insider due to our diverse services that span across geographical boundaries.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading-11">
                        <a class="d-block" href="#" data-toggle="collapse" data-target="#collapse-11"
                           aria-expanded="false" aria-controls="collapseOne">{{ __('Where are You Located and Where Is My Writer From? ') }}</a>
                    </div>

                    <div id="collapse-11" class="collapse" aria-labelledby="heading-11" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{ __('We are based in Hongkong. At Mycustomessays.com, we hire only native English speakers from the US, the UK, Canada, and Australia. We have writers from all major time zones so you’ll never have to worry about that 4-hour urgent order as we’ll deliver it on time. ') }}</p>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="heading-21">
                        <a class="d-block" href="#" data-toggle="collapse" data-target="#collapse-21"
                           aria-expanded="false" aria-controls="collapseOne">{{ __('Who Writes My Essay? ') }}</a>
                    </div>

                    <div id="collapse-21" class="collapse" aria-labelledby="heading-21" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{ __('When you place an order, one of our admin staff will assign the best niche writer for you. You can also choose the writer you want to handle your assignment as you’ll be able to see all the writers’ profiles, including ratings and the number of completed assignments.') }}</p>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header" id="heading-31">
                        <a class="d-block" href="#" data-toggle="collapse" data-target="#collapse-31"
                           aria-expanded="false" aria-controls="collapseOne">{{ __('Will My Paper Be Written From Scratch?') }} </a>
                    </div>

                    <div id="collapse-31" class="collapse" aria-labelledby="heading-31" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{ __('Yes! We do not resell or reuse written papers. All your work will be written from scratch and run through our plagiarism checker for originality. We do not tolerate plagiarism and we guarantee 100% plagiarism-free papers in line with our quality policy. ') }}</p>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="heading-41">
                        <a class="d-block" href="#" data-toggle="collapse" data-target="#collapse-41"
                           aria-expanded="false" aria-controls="collapseOne">{{ __('How Will I Receive My Paper? ') }}</a>
                    </div>

                    <div id="collapse-41" class="collapse" aria-labelledby="heading-41" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{ __('Once your paper is ready, you’ll be able to download it in Ms. Word format. The download button will automatically appear on your order page and you’ll be able to click the button and save the work to your computer. ') }}</p>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="heading-51">
                        <a class="d-block" href="#" data-toggle="collapse" data-target="#collapse-51"
                           aria-expanded="false" aria-controls="collapseOne">{{ __('What If I Don’t Like my Essay?') }} </a>
                    </div>

                    <div id="collapse-51" class="collapse" aria-labelledby="heading-51" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{ __('The paper you’ll receive from us will have passed our rigorous quality control tests so you don’t have to worry about quality. But in the event the work doesn’t meet your standards or is lacking in some areas, you can always request edits, and we guarantee unlimited edits until the work meets your expectations. If that doesn’t work for you, you can take advantage of our 100% money back guarantee and request a refund.  ') }}</p>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header" id="heading-61">
                        <a class="d-block" href="#" data-toggle="collapse" data-target="#collapse-61"
                           aria-expanded="false" aria-controls="collapseOne">{{ __('Which Citation Styles Do You Work With? ') }}</a>
                    </div>

                    <div id="collapse-61" class="collapse" aria-labelledby="heading-61" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{ __('Mycustomessays.com works with all citation styles used in all American colleges and universities. Our writers are conversant with all the four standard styles—APA, MLA, Chicago, and Harvard. In addition, we also cover Oxford, ASA, AMA, CMS, IEEE, and ASA. Just tell us your preferred citation style and we’ll do the rest.') }}</p>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header" id="heading-71">
                        <a class="d-block" href="#" data-toggle="collapse" data-target="#collapse-71"
                           aria-expanded="false" aria-controls="collapseOne">{{ __('Can I Get a Discount? ') }}</a>
                    </div>

                    <div id="collapse-71" class="collapse" aria-labelledby="heading-71" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{ __('Yes! We offer discounts and coupons to both first-time and return customers from time to time. Check our website regularly for information on discounts. ') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
