<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Application fermée </title>
    <meta property="og:title" content="Coming Soon">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="https://uselooper.com">
    <meta property="og:url" content="https://uselooper.com">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <meta name="theme-color" content="#3063A0"><!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/theme.min.css') }}" data-skin="default">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/theme-dark.min.css') }}" data-skin="dark">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/custom.css') }}">
    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        // Disable unused skin immediately
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        // add flag class to html immediately
        if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script><!-- END THEME STYLES -->
</head>

<body>
    <!--[if lt IE 10]>
    <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
    <![endif]-->
    <!-- .empty-state -->
    <main id="comingsoon" class="empty-state empty-state-fullpage bg-primary text-white"
        style="background-image: url({{ asset('assets/images/illustration/img-1.png)') }};">
        <!-- .empty-state-container -->
        <div class="empty-state-container">
            <h1 class="state-header" style="letter-spacing: 4px;"> Application fermée </h1>
            <div id="clock" class="countdown display-1">
                <div class="countdown-item"> 00 <small>Days</small>
                </div>
                <div class="countdown-item"> 00 <small>Hr</small>
                </div>
                <div class="countdown-item"> 00 <small>Min</small>
                </div>
                <div class="countdown-item"> 00 <small>Sec</small>
                </div>
            </div>
            {{-- <p class="state-description lead"> We're a Creative Agency based in Europe. Be the first to know when we
                live. </p> --}}
            {{-- <form class="w-75 mx-auto">
                <div class="form-group">
                    <div class="input-group bg-white border-white input-group-lg circle">
                        <input type="email" class="form-control text-black" placeholder="Your email">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-warning circle"><span
                                    class="d-none d-sm-inline">Subcribe</span> <span class="d-inline d-sm-none"
                                    aria-label="Subcribe"><i class="fa fa-arrow-circle-right"></i></span></button>
                        </div>
                    </div>
                </div>
            </form> --}}
            {{-- <div class="state-action">
                <a href="#" class="btn btn-reset"><i class="fab fa-fw fa-facebook"></i></a> <a href="#"
                    class="btn btn-reset"><i class="fab fa-fw fa-twitter"></i></a> <a href="#"
                    class="btn btn-reset"><i class="fab fa-fw fa-instagram"></i></a> <a href="#"
                    class="btn btn-reset"><i class="fab fa-fw fa-linkedin"></i></a>
            </div> --}}
        </div><!-- /.empty-state-container -->
    </main><!-- /.empty-state -->
    <!-- BEGIN BASE JS -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="{{ asset('assets/vendor/particles.js/particles.js') }}"></script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="{{ asset('assets/javascript/theme.min.js') }}"></script> <!-- END THEME JS -->
    <!-- BEGIN JS -->
    <script>
        /**
         * Keep in mind that your scripts may not always be executed after the theme is completely ready,
         * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
         */
        $(document).on('theme:init', () => {
            document.querySelector('#clock').innerHTML = 'Nous serons de retour bientot';
            /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
            particlesJS.load('comingsoon', '{{ asset('assets/javascript/pages/particles-comingsoon.json') }}');
            // Set the date we're counting down to
            var countDownDate = new Date('August 10, 2020 15:37:25').getTime();
            var countDownFormater = function(i) {
                return i < 10 ? '0' + i : i;
            }
            // Update the count down every 1 second
            // var countDown = setInterval(function() {
            //     // Get todays date and time
            //     var now = new Date().getTime();
            //     // Find the distance between now an the count down date
            //     var distance = -1;
            //     // Time calculations for days, hours, minutes and seconds
            //     // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            //     // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            //     // var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            //     // var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            //     // Display the result in the element with id='clock'
            //     // document.querySelector('#clock').innerHTML = '' + '<div class="countdown-item">' +
            //     //     countDownFormater(days) + ' <small>Days<\/small><\/div>' +
            //     //     '<div class="countdown-item">' + countDownFormater(hours) +
            //     //     ' <small>Hr<\/small><\/div>' + '<div class="countdown-item">' + countDownFormater(
            //     //         minutes) + ' <small>Min<\/small><\/div>' + '<div class="countdown-item">' +
            //     //     countDownFormater(seconds) + ' <small>Sec<\/small><\/div>';
            //     // If the count down is finished, write some text
            // //     if (distance < 0) {
            // //         clearInterval(countDown);
            // //         document.querySelector('#clock').innerHTML = 'We\'ll Live Soon';
            // //     }
            // // }, 1000);
        })
    </script> <!-- END JS -->
</body>

</html>
