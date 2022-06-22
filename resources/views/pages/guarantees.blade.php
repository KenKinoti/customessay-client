@extends('layouts.page')
@section('title', "We Guarantee and deliver top notch assignments ")
@section('meta')
<meta name="description"content="Order your paper now and get free plagiarism report"/>
<meta name="title" content="Plagiarism Free Guarantee When You Order with us "/>
<link rel="canonical" href=" https://mycustomessays.com/guarantees" />
<meta name="twitter:card" content="Summary" />
<meta name="robots" content="follow, index "/>
<meta name="twitter:url" content="https://mycustomessays.com/guarantees"/>
<meta property="article:published_time" content=" "/>
<meta property="article_updated_time" content=" "/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="Website"/>
@endsection



@section('page')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div  class="gurantee py-5 pr-5 px-5 bg-primary text-white">
                    <h1 class="text-center text-white">{{ __('Welcome On board') }}</h1>
                    <p>{{ __('We don’t waste time badmouthing our competitors about their low-quality services. Instead, we ask our new customers to try us out and bear witness to the quality of our services. There must be a reason 98% of our customers come back right? Well, there is. We know how to take care of them.') }}
                    </p>
                </div>                
            </div>

           
            <div class="col-md-12 mt-5 ">
                 <p>{{ __('We are so confident in our services that we are going to give you a 100% money back guarantee in the event that the services we provide are not as expected. Mycustomessays.com is the only custom essay writing service that produces extensively researched 100% original content. 
                 We safeguard any information obtained from our customers in keeping with our privacy policy. Our company also guarantees you 100% plagiarism-free papers, a money-back guarantee, and free revisions according to our Revision Policy.') }}</p>
            </div>
            
        </div>
    </div>
</section>


<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center">{{ __('And more reasons to order our custom paper writing services') }}</h2>
        <div class="row mb-5">
            <div class="col-md-6">
                 <i class="ti ti-lock gurantee-color" aria-hidden="true" > </i>
                <h3>{{ __('Privacy Guarantee ') }}</h3>
                <p>{{ __('Mycustomessays.com is committed to protecting the privacy of the customer and it will never resell or share any of the customer’s personal information. The company does not use this information for any other purpose other than for verification purposes on matters related to the customer’s account and/or orders.') }}</p>                
            </div>

             <div class="col-md-6">
                 <i class="ti ti-notepad gurantee-color" aria-hidden="true" > </i>
                <h3>{{ __('Plagiarism Free Guarantee ') }}</h3>
                <p>{{ __('We do not sell pre-written essays. All of our essays are custom written. They are 100% original and appropriately cited. Furthermore, we check all papers for plagiarism before delivering them to the client. Our plagiarism detection software is updated on a regular basis to ensure that the plagiarism reports it produces are reliable.') }}  </p>                
            </div>


             <div class="col-md-6">
                 <i class="ti ti-face-smile gurantee-color" aria-hidden="true" > </i>
                <h3>{{ __('Satisfaction Guarantee') }}</h3>
                <p>{{ __('Mycustomessays.com produces high-quality products for its clients. Our professional team of writers works round the clock to ensure the papers delivered to our customers are 100% original and high-quality. Moreover, our Quality Assurance department reviews our writers’ performance from time to time to ensure our quality over quantity policy is enforced. We are so confident in the quality of our services that we give our customers a 100% money-back guarantee.') }}</p>                
            </div>

             <div class="col-md-6">
                 <i class="ti ti-money gurantee-color" aria-hidden="true" > </i>
                <h3>{{ __('Money-Back Guarantee ') }}</h3>
                <p>{{ __('Our money Back Guarantee allows our customers to request a partial or full refund in the event the customer is not satisfied with the quality of our services. Our success rate coupled with the quality guarantee from first-hand users makes us the top in the industry. In fact, about 90% of our customers are return clients. Nevertheless, the company processes all refund requests within six business days.') }}</p>                
            </div>
        </div>
    </div>
</section>
    

    @include('pages.partials.steps')

   
@endsection
