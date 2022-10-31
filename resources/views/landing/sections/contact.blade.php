<div class="contact-area contact-bg" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="contact-outer-area">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="content-form-wrapper">
                                <div class="section-title center-aligned">
                                    <h2 class="title">Contact us</h2>
                                    <p>{{getSystemSetting('contact_sub_title')}}</p>
                                </div>
                                <form method="post" action="{{route('contact.store')}}"
                                    class="contact-form" >
                                    @include('layouts.include.flash-message')
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input required type="text" name="name" id="name" class="form-control"
                                                    placeholder="Your Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input required type="email" name="email" id="email" class="form-control"
                                                    placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input required type="text" name="subject" id="subject" class="form-control"
                                                    placeholder="Subject">
                                            </div>
                                            <div class="form-group textarea">
                                                <textarea required name="message" id="message" class="form-control" placeholder="Message" cols="30" rows="10"></textarea>
                                            </div>
                                            <button class="submit-btn w180px gd-bg" type="submit">Submit
                                                Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
