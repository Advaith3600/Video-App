<!DOCTYPE html>
<html lang="en">

@include('partials.app')

<body>

    <!-- ======= Header ======= -->
    @include('partials.header')
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    @include('partials.banner')
    <!-- End Hero -->

    <main id="main">

        <!-- ======= Home Section ======= -->
        <section id="services" class="section">
            <div class="container" style="padding: 10% 0% 0%">

                <div style="padding-bottom:5% " class="row justify-content-center text-center mb-5">
                    <div class="col-md-5" data-aos="fade-up">
                        <h2 class="section-heading">Services we provide</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="">
                        <div class="feature-1 text-center">
                            <div class="wrap-icon icon-1">
                                <i class="bi bi-phone-fill"></i>
                            </div>
                            <h3 class="mb-3">Mobile Application</h3>
                            <p>Develops mobile applications for both ios & android.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-1 text-center">
                            <div class="wrap-icon icon-1">
                                <i class="bi bi-display-fill"></i>
                            </div>
                            <h3 class="mb-3">Desktop Application</h3>
                            <p>Develops desktop application for windows, linux & mac os.</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-1 text-center">
                            <div class="wrap-icon icon-1">
                                <i class="bi bi-cloud-fill"></i>
                            </div>
                            <h3 class="mb-3">Web Application</h3>
                            <p>We develop web application for all of your business needs.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row justify-content-center text-center mb-5" data-aos="fade">
                    <div class="col-md-6 mb-5">
                        <img src="assets/img/workflow_2.jpg" alt="Image" class="img-fluid">
                    </div>
                </div>
                <div style="padding-top: 5%" id="wp" class="row justify-content-center text-center mb-5">
                    <div class="col-md-5" data-aos="fade-up">
                        <h2 class="section-heading">Our work process</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="step">
                            <span class="number">#1</span>
                            <h3>PLANNING & ANALYSIS</h3>
                            <p>Business requirements are gathered & analyzed for their validity and the possibility in
                                this phase</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step">
                            <span class="number">#2</span>
                            <h3>DESIGN</h3>
                            <p>The system and software design is prepared from the requirement
                                specifications which were studied in the first phase</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step">
                            <span class="number">#3</span>
                            <h3>CODING</h3>
                            <p>On receiving system design documents, the work is divided in modules/units and actual
                                coding is started</p>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 2%">
                    <div class="col-md-4">
                        <div class="step">
                            <span class="number">#4</span>
                            <h3>TESTING</h3>
                            <p>After the code is developed it is tested against the requirements to make sure that the
                                product is actually solving the needs</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step">
                            <span class="number">#5</span>
                            <h3>DEPLOY</h3>
                            <p>After successful testing the product is delivered / deployed to the customer for their
                                use</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step">
                            <span class="number">#6</span>
                            <h3>MAINTENANCE</h3>
                            <p>When customer starts using the developed system then the actual problems occurs
                                and needs to be solved from time to time.</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- ======= Team Section ======= -->
        <section class="section team">
            <div class="container">
                <div class="row justify-content-center text-center mb-5" data-aos="fade">
                    <div class="col-md-6 mb-5">
                        <img src="assets/img/team.png" alt="Image" class="img-fluid">
                    </div>
                </div>
                <div id="team" style="padding-top: 5% 0% 25% 0%" class="row justify-content-center text-center mb-5">
                    <div class="col-md-5" data-aos="fade-up">
                        <h2 class="section-heading">Our Team</h2>
                    </div>
                </div>
                <div class="row justify-content-center text-center">
                    <div class="col-md-2" data-aos="fade-up" data-aos-delay="">
                        <div class="member" style="cursor: pointer">
                            <img style="filter: grayscale(100%);border-radius: 50%;" src="assets/img/hari.png"
                                class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>HARIKRISHNA A J</h4>
                                    <span>Founder & CEO</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" data-aos="fade-up" data-aos-delay="">
                        <div class="member" style="cursor: pointer;">
                            <img style="filter: grayscale(100%);border-radius: 50%;" src="assets/img/advaith.png"
                                class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>ADVAITH A J</h4>
                                    <span>Co Founder & Web Developer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" data-aos="fade-up" data-aos-delay="">
                        <div class="member" style="cursor: pointer;">
                            <img style="filter: grayscale(100%);border-radius: 50%;" src="assets/img/m1.png"
                                class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4></h4>
                                    <span>System Administrator</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" data-aos="fade-up" data-aos-delay="">
                        <div class="member" style="cursor: pointer;">
                            <img style="filter: grayscale(100%);border-radius: 50%;" src="assets/img/arun.jpg"
                                class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4></h4>
                                    <span>Network Administrator</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- 
        <section class="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 me-auto">
                        <h2 class="mb-4">Seamlessly Communicate</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur at
                            reprehenderit optio,
                            laudantium eius quod, eum maxime molestiae porro omnis. Dolores aspernatur delectus impedit
                            incidunt
                            dolore mollitia esse natus beatae.</p>
                        <p><a href="#" class="btn btn-primary">Download Now</a></p>
                    </div>
                    <div class="col-md-6" data-aos="fade-left">
                        <img src="assets/img/undraw_svg_2.svg" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </section> --}}
        {{-- 
        <section class="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 ms-auto order-2">
                        <h2 class="mb-4">Gather Feedback</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur at
                            reprehenderit optio,
                            laudantium eius quod, eum maxime molestiae porro omnis. Dolores aspernatur delectus impedit
                            incidunt
                            dolore mollitia esse natus beatae.</p>
                        <p><a href="#" class="btn btn-primary">Download Now</a></p>
                    </div>
                    <div class="col-md-6" data-aos="fade-right">
                        <img src="assets/img/undraw_svg_3.svg" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- ======= Testimonials Section ======= -->
        {{-- <section class="section border-top border-bottom">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-md-4">
                        <h2 class="section-heading">Review From Our Users</h2>
                    </div>
                </div>
                <div class="row justify-content-center text-center">
                    <div class="col-md-7">

                        <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="review text-center">
                                        <p class="stars">
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill muted"></span>
                                        </p>
                                        <h3>Excellent App!</h3>
                                        <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea
                                                delectus pariatur, numquam
                                                aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae
                                                deleniti minus animi,
                                                provident voluptates consectetur maiores quos.</p>
                                        </blockquote>

                                        <p class="review-user">
                                            <img src="assets/img/person_1.jpg" alt="Image"
                                                class="img-fluid rounded-circle mb-3">
                                            <span class="d-block">
                                                <span class="text-black">Jean Doe</span>, &mdash; App User
                                            </span>
                                        </p>

                                    </div>
                                </div><!-- End testimonial item -->

                                <div class="swiper-slide">
                                    <div class="review text-center">
                                        <p class="stars">
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill muted"></span>
                                        </p>
                                        <h3>This App is easy to use!</h3>
                                        <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea
                                                delectus pariatur, numquam
                                                aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae
                                                deleniti minus animi,
                                                provident voluptates consectetur maiores quos.</p>
                                        </blockquote>

                                        <p class="review-user">
                                            <img src="assets/img/person_2.jpg" alt="Image"
                                                class="img-fluid rounded-circle mb-3">
                                            <span class="d-block">
                                                <span class="text-black">Johan Smith</span>, &mdash; App User
                                            </span>
                                        </p>

                                    </div>
                                </div><!-- End testimonial item -->

                                <div class="swiper-slide">
                                    <div class="review text-center">
                                        <p class="stars">
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill"></span>
                                            <span class="bi bi-star-fill muted"></span>
                                        </p>
                                        <h3>Awesome functionality!</h3>
                                        <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea
                                                delectus pariatur, numquam
                                                aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae
                                                deleniti minus animi,
                                                provident voluptates consectetur maiores quos.</p>
                                        </blockquote>

                                        <p class="review-user">
                                            <img src="assets/img/person_3.jpg" alt="Image"
                                                class="img-fluid rounded-circle mb-3">
                                            <span class="d-block">
                                                <span class="text-black">Jean Thunberg</span>, &mdash; App User
                                            </span>
                                        </p>

                                    </div>
                                </div><!-- End testimonial item -->

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- End Testimonials Section -->

        <!-- ======= CTA Section ======= -->
        {{-- <section class="section cta-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 me-auto text-center text-md-start mb-5 mb-md-0">
                        <h2>Starts Publishing Your Apps</h2>
                    </div>
                    <div class="col-md-5 text-center text-md-end">
                        <p><a href="#" class="btn d-inline-flex align-items-center"><i
                                    class="bx bxl-apple"></i><span>App store</span></a> <a href="#"
                                class="btn d-inline-flex align-items-center"><i
                                    class="bx bxl-play-store"></i><span>Google play</span></a></p>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- End CTA Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('partials.footer')
    <!-- ======= End Footer ==== -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>