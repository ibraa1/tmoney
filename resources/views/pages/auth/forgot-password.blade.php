<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Reinitialisation mot de passe | TMoney </title>
    <meta property="og:title" content="Password Reset">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="https://uselooper.com">
    <meta property="og:url" content="https://uselooper.com">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">
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
        "headline": "Password Reset",
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
    <div class="page-message"
        role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link"
        href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
    <![endif]-->
    <!-- .auth -->
    <main class="auth">


        <!-- form -->
        <!-- form -->
        <form method="POST"
        action="{{ route('password.email') }}" class="auth-form auth-form-reflow">
    @csrf
    <div class="text-center mb-4">
        <div class="mb-4">
            <img class="rounded" src="assets/apple-touch-icon.png" alt="" height="72">
        </div>
        <h1 class="h3"> Réinitialiser votre mot de passe </h1>
        <br>
        @if ($message = Session::get('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <i class="nc-icon nc-simple-remove"></i>
                </button>
                <p>{{ $message }}</p>
            </div> @endif
            @if ($errors->has('email'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <i class="nc-icon nc-simple-remove"></i>
                </button>
                <p>{{ $errors->first('email') }}</p>
                 </div> @endif
    </div>
    <!-- .form-group -->
    <div class="form-group
        mb-4">
    <label class="d-block text-left" for="inputUser">Email</label> <input type="text" id="inputUser"
        class="form-control form-control-lg" name="email" required="" autofocus="">
    <p class="text-muted">
        <small>Nous enverrons un lien de réinitialisation de mot de passe à votre adresse e-mail.</small>
    </p>
    </div><!-- /.form-group -->
    <!-- actions -->
    <div class="d-block d-md-inline-block mb-2">
        <button class="btn btn-lg btn-block btn-primary" type="submit">Réinitialiser</button>
    </div>
    <div class="d-block d-md-inline-block">
        <a href="{{ route('login') }}" class="btn btn-block btn-light">Retour à la connexion</a>
    </div>
    </form><!-- /.auth-form -->
    <footer class="auth-footer mt-5"> © 2023 All Rights Reserved
    </footer>
    </main><!-- /.auth -->
    <!-- BEGIN BASE JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/popper.js/umd/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN THEME JS -->
    <script src="assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
    </body>

</html>
