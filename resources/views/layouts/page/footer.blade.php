<footer class="bg-footing py-5 " id="footer" >
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-3">
                 <a href="{{ url('/') }}"> <img src="{{asset('images/logo2.png')}}" class="img-fluid "  alt="logo"></a>
            </div>
            <div class="col-md-6">
                <ul  class="nav text-white" >
                <li class="py-0 px-1"><a href="{{ url('guarantees') }}"  class="text-white">   @lang('nav.page.guarantees')</a></li>
                <li class="py-0 px-1"><a href="{{ url('samples') }}"  class="text-white">   @lang('nav.page.samples')</a></li>
                <li class="py-0 px-1"><a href="{{ url('blog') }}"  class="text-white"> {{ __('Blog ') }}</a></li>
                  <li class="py-0 px-1"><a href="{{ url('contact') }}"  class="text-white">{{ __(' Contact Us') }} </a></li>
                     
                </ul>
            </div>
            <div class="col-md-3"> 
                  <ul  class="nav" >
           
                         <li class="footer-border">
                          <a class="nav-link" href="{{ route('enquiry.create') }}" ><span class="pb_rounded-4 px-4 cta text-secondary" > {{ __('Free Inquiry') }}</span></a></li>
                      </ul>
            </div>
             
              <div class="col-md-9 ">
                <p class="text-white mt-2">{{ __('Disclaimer: mycustomessays.com provides custom writing and research services to its clients for limited use only as provided in its terms and conditions. It does not give its consent or authority to the client to copy and reproduce entirely or a portion of any term paper, research paper, thesis paper, essay, dissertation or other products of the company without proper reference. The company will not be responsible to third parties for the unauthorized use of its products.') }}</p>
            </div>

             <div class="col-md-3">
               <a href="#">  <i class="ti ti-facebook social-foot" aria-hidden="true" > </i></a>
                 <a href="#"> <i class="ti ti-twitter social-tw" aria-hidden="true" > </i></a>
                 <a href="#"> <i class="ti ti-linkedin social-lk" aria-hidden="true" > </i></a>
            </div>

           
        </div>
    </div>

     <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-8">
               <ul  class="nav" >
                <li  class="py-0 px-1" ><a href="{{ url('terms-and-conditions') }}" class="text-white"> {{ __('Terms & Conditions') }} </a></li>
                      <li  class="py-0 px-1 text-white" >

                
                </ul>
            </div>
             <div class="col-md-4">
           
            </div>


             <div class="col-md-12">
                <h6 class="text-white mt-4 mx-auto d-block text-center "> © Copyright {{ date('Y') }} All rights reserved.</h6> 
            </div>
           
        </div>
    </div>
</footer>
