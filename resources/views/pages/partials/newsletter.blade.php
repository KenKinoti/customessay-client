<section class="bg-grey py-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>Sign up for our newsletter</h3>
                <p>Get the latest offers and events directly to your email.</p>
            </div>
            <div class="col-sm-8">
                <form method="post" action="{{ route('news-letters.sign-up') }}" class="validate-form">
                    @csrf()
                    <div class="row">
                        <div class="col-sm-4 offset-sm-1">
                            <input type="text" placeholder="Name" id="name" name="name"
                                   data-rule-required="true"
                                   data-rule-maxlength="255"
                                   class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" placeholder="E-mail Address" id="email" name="email"
                                   data-rule-email="true"
                                   data-rule-required="true"
                                   data-rule-maxlength="255"
                                   class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-form btn-warning btn-circled">
                                <i class="far fa-check-circle"></i>
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>