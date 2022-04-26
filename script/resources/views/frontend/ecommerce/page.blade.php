@extends('frontend.ecommerce.layouts.app')

@section('content')

    <section class="bg-light">
        <!-- about wrapper start -->
        <div class="about-us-wrapper pt-5 pb-4">
            <div class="container">
                <div class="row">
                    <!-- About Text Start -->
                    <div class="col-lg-6 order-last order-lg-first">
                        <div class="about-text-wrap">
                            <h2><span>Provide Best</span>Product For You</h2>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium,

                                On the other hand, we denounce with righteous indignation and dislike men who are so
                                beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire,
                                that they cannot foresee the pain and trouble that are bound to ensue; and equal blame
                                belongs to those who fail in their duty through weakness of will, which is the same as
                                saying through shrinking from toil and pain. These cases are perfectly simple and easy
                                to distinguish. In a free hour, when our power of choice is untrammelled and when
                                nothing prevents our being able to do what we like best, every pleasure is to be
                                welcomed and every pain avoided. But in certain circumstances and owing to the claims of
                                duty or the obligations of business it will frequently occur that pleasures have to be
                                repudiated and annoyances accepted. The wise man therefore always holds in these matters
                                to this principle of selection: he rejects pleasures to secure other greater pleasures,
                                or else he endures pains to avoid worse pains.
                            </p>
                        </div>
                    </div>
                    <!-- About Text End -->
                    <!-- About Image Start -->
                    <div class="col-lg-5 col-md-10">
                        <div class="about-image-wrap">
                            <img class="img-fluid"
                                 src="{{ asset('frontend/ecommerce/images/banner/about.jpg') }}"
                                 alt="About Us"/>
                        </div>
                    </div>
                    <!-- About Image End -->
                </div>
            </div>
        </div>
        <!-- about wrapper end -->
    </section>

@endsection

