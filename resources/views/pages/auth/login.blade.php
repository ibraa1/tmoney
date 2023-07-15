<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Connexion | TMoney</title>
    <meta property="og:title" content="Sign In">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="https://uselooper.com">
    <meta property="og:url" content="https://uselooper.com">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="application/ld+json">
      {
        "name": "Looper - Bootstrap 4 Admin Theme",
        "description": "Responsive admin theme build on top of Bootstrap 4",
        "author":
        {
          "@type": "Person",
          "name": "Beni Arisandi"
        },
        "@type": "WebSite",
        "url": "",
        "headline": "Sign In",
        "@context": "http://schema.org"
      }
    </script><!-- End SEO tag -->
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <meta name="theme-color" content="#3063A0"><!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet"
        href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="assets/stylesheets/theme.min.css" data-skin="default">
    <link rel="stylesheet" href="assets/stylesheets/theme-dark.min.css" data-skin="dark">
    <link rel="stylesheet" href="assets/stylesheets/custom.css">
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
    <!-- .auth -->
    <main class="auth">

        <header id="auth-header" class="auth-header"
            style="background-image: url(assets/images/illustration/img-1.png);">
            <h1>
                <img src="{{ asset('assets/images/logo.png') }}" alt="Se connecter" style="height: 200px; width: 300px">
                <span class="sr-only">Se connecter</span>
            </h1>
        </header><!-- form -->
        <form class="auth-form" method="POST" action="{{ route('login') }}">
              @csrf
            @if ($message = Session::get('error'))
                <div class="alert alert-danger"
                    style="border-radius: 4px; height: 40px; text-align:center; width:100%;">
                    <p>{{ $message }}</p>
                </div> @endif
                @if ($message = Session::get('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <i class="nc-icon nc-simple-remove"></i>
                </button>
                <p>{{ $message }}</p>
            </div> @endif
            <!-- .form-group -->
    <div class="form-group">
    <div class="form-label-group">
        <input type="text" name="email" id="inputUser" class="form-control" placeholder="Email" autofocus="">
        <label for="inputUser">Email</label>
        @error('email')
            <div class="">
                {{ $errors->first('email') }}
            </div>
        @enderror
    </div>
    </div><!-- /.form-group -->
    <!-- .form-group -->
    <div class="form-group">
        <div class="form-label-group">
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Mot de passe">
            <label for="inputPassword">Mot de passe</label>
        </div>
        @error('password')
            <div class="">
                {{ $errors->first('password') }}
            </div>
        @enderror
    </div>
    @if (config('services.recaptcha.key'))
    <div class="form-group">
        <div class="g-recaptcha"
            data-sitekey="{{ config('services.recaptcha.key') }}">
        </div>
        @error('g-recaptcha-response')
            <div class="">
                {{ $errors->first('g-recaptcha-response') }}
            </div>
        @enderror
    </div> @endif
    <div class="form-group">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
    </div><!-- /.form-group -->
    <!-- .form-group -->
    {{-- <div class="form-group text-center">
          <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remember-me"> <label class="custom-control-label" for="remember-me">Keep me sign in</label>
          </div>
        </div><!-- /.form-group --> --}}
    <!-- recovery links -->
    <div class="text-center pt-3">
        <span class="mx-2">·</span><a href="{{ route('password.request') }}" class="link">Mot de passe oublié?</a>
    </div><!-- /recovery links -->
    </form><!-- /.auth-form -->
    <!-- copyright -->
    <footer class="auth-footer"> © 2023 All Rights Reserved.
    </footer>
    </main><!-- /.auth -->
    <!-- BEGIN BASE JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/popper.js/umd/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="assets/vendor/particles.js/particles.js"></script>
    <script>
        /**
         * Keep in mind that your scripts may not always be executed after the theme is completely ready,
         * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
         */
        $(document).on('theme:init', () => {
            /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
            particlesJS.load('auth-header', 'assets/javascript/pages/particles.json');
        })
    </script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="assets/javascript/theme.js"></script>
    <script src="{{ asset('assets/javascript/tmoney.js') }}"></script>
    </body>

</html>
