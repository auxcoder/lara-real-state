@extends('frontend.layout.app')
@section('title', 'Frequently Asked Questions | {{ config('company.name') }}')
@section('description', 'Find answers to common questions about inmobiliaria en España, property investment, and our services. Get expert guidance from {{ config('company.name') }} team.')
@section('content')
<section class="faqbg1">
    <div class="faq-item-bg">
        <div class="container">
            <h3 class="bg1-a">Faqs</h3>
            <h4 class="bg1-b">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et gravida neque.
                Donec vestibulum urna vel neque condimentum sagittis. Cras auctor sit amet lacus eget pretium.
                Praesent id sapien nec nulla posuere vehicula ac a quam.</h4>
        </div>
    </div>
</section>

<section class="faqbg2">
    <div class="container">
        <h3 class="faq-a">FAQS</h3>
        <p class="faq-b">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et gravida neque. Donec
            vestibulum urna vel neque condimentum sagittis. Cras auctor sit amet.</p>
        <p class="faq-b">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et gravida neque. Donec
            vestibulum urna vel neque condimentum sagittis. Cras auctor sit amet lacus eget pretium. Praesent id
            sapien nec nulla posuere vehicula ac a quam. Donec scelerisque et libero at sagittis. Mauris sed
            eleifend dui, non pulvinar dolor. Nulla lectus ex, tempus nec ullamcorper ac, tristique ac neque.</p>
    </div>
    <div class="container">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Vestibulum Et Gravida Neque.
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et gravida neque. Donec
                        vestibulum urna vel neque condimentum sagittis. Cras auctor sit amet lacus eget pretium.
                        Praesent id sapien nec nulla posuere vehicula ac a quam. Donec scelerisque et libero at
                        sagittis. Mauris sed eleifend dui, non pulvinar dolor. Nulla lectus ex, tempus nec
                        ullamcorper ac, tristique ac neque.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Vestibulum Et Gravida Neque.
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et gravida neque. Donec
                        vestibulum urna vel neque condimentum sagittis. Cras auctor sit amet lacus eget pretium.
                        Praesent id sapien nec nulla posuere vehicula ac a quam. Donec scelerisque et libero at
                        sagittis. Mauris sed eleifend dui, non pulvinar dolor. Nulla lectus ex, tempus nec
                        ullamcorper ac, tristique ac neque.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Vestibulum Et Gravida Neque.
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et gravida neque. Donec
                        vestibulum urna vel neque condimentum sagittis. Cras auctor sit amet lacus eget pretium.
                        Praesent id sapien nec nulla posuere vehicula ac a quam. Donec scelerisque et libero at
                        sagittis. Mauris sed eleifend dui, non pulvinar dolor. Nulla lectus ex, tempus nec
                        ullamcorper ac, tristique ac neque.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Vestibulum Et Gravida Neque.
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et gravida neque. Donec
                        vestibulum urna vel neque condimentum sagittis. Cras auctor sit amet lacus eget pretium.
                        Praesent id sapien nec nulla posuere vehicula ac a quam. Donec scelerisque et libero at
                        sagittis. Mauris sed eleifend dui, non pulvinar dolor. Nulla lectus ex, tempus nec
                        ullamcorper ac, tristique ac neque.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Vestibulum Et Gravida Neque.
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et gravida neque. Donec
                        vestibulum urna vel neque condimentum sagittis. Cras auctor sit amet lacus eget pretium.
                        Praesent id sapien nec nulla posuere vehicula ac a quam. Donec scelerisque et libero at
                        sagittis. Mauris sed eleifend dui, non pulvinar dolor. Nulla lectus ex, tempus nec
                        ullamcorper ac, tristique ac neque.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="bg4-b">Our Mission</h4>
                <p class="bg4-c">Our mission is to empower individuals and businesses to exchange goods and services
                    without the need for cash, promoting a more sustainable and collaborative economy.</p>
                <!-- <h4 class="bg4-a">Our vision</h4> -->
                <h4 class="bg4-b">Our Values</h4>
                <ul class="bg4-ul">
                    <li><b>Community:</b> We believe in building strong relationships and connections.</li>
                    <li><b>Trust: </b> We prioritize transparency, security, and reliability. </li>
                    <li><b>Innovation:</b> We strive to make bartering easy and accessible.</li>
                    <li><b>Sustainability:</b> We aim to reduce waste and promote a sharing economy.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/images/bg3.png') }}" class="bg4-img" />
            </div>
        </div>
    </div>
</section>

<section class="bg6">
    <div class="container">
        <h4 class="bg6-a">Get in touch</h4>
        <h4 class="bg6-b">SUBSCRIBE TO OUR NEWSLETTER</h4>
        <p class="bg6-c">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et gravida neque. Donec
            vestibulum urna vel neque condimentum sagittis. Cras auctor sit amet lacus eget pretium. Praesent id
            sapien nec nulla.</p>
        <form>
            <input class="bg6-input" type="email" placeholder="Enter your email address:" required />
            <input type="submit" class="bg6-submit" value="Subscribe" />
        </form>
    </div>
</section>
@endsection
