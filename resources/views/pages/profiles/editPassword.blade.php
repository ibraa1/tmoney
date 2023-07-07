@extends('layouts.body')
@section('title', 'Modifier le mot de passe | TMoney')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="nc-icon nc-simple-remove"></i>
            </button>
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="nc-icon nc-simple-remove"></i>
            <p>{{ $message }}</p>
        </div>
    @endif

    <header class="page-cover">
        <div class="text-center">
            <a href="" class="user-avatar user-avatar-xl"><img src="{{ asset(Auth::user()->image) }}"
                    alt=""></a>
            <h2 class="h4 mt-2 mb-0"> {{ Auth::user()->prenom }} {{ Auth::user()->nom }} </h2>
            <div class="my-1">
                <i class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i
                    class="fa fa-star text-yellow"></i> <i class="fa fa-star text-yellow"></i> <i
                    class="fa fa-star text-yellow"></i>
            </div>
            <p class="text-muted">{{ Str::ucfirst(Auth::user()->role) }} TMoney </p>

        </div><!-- .cover-controls -->
        <div class="cover-controls cover-controls-bottom">
            <div style="background-color: gainsboro">Balances: <br>
                @foreach (Auth::user()->balances as $balance)
                    {{ $balance->montant }} {{ $balance->detailBalance->devise->deviseEntree }}<br>
                @endforeach
            </div>
        </div><!-- /.cover-controls -->
    </header><!-- /.page-cover -->
    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Profil</a>
                    </li>
                </ol>
            </nav>
        </header><!-- /.page-title-bar -->
        <!-- .page-section -->
        <div class="page-section">
            <!-- grid row -->
            <div class="row">
                <!-- grid column -->
                <div class="col-lg-4">
                    <!-- .card -->
                    <div class="card card-fluid">
                        <h6 class="card-header"> Vos Informations </h6><!-- .nav -->
                        <nav class="nav nav-tabs flex-column border-0">
                            <a href="{{ route('profilePicture.edit', Auth::user()->id) }}" class="nav-link">Photo de
                                profil</a> <a href="{{ route('profile.editPassword', Auth::user()->id) }}"
                                class="nav-link active">Mot de passe</a> <a
                                href="{{ route('profile.edit', Auth::user()->id) }}" class="nav-link">Informations de
                                profil</a>
                        </nav><!-- /.nav -->
                    </div><!-- /.card -->
                </div><!-- /grid column -->
                <!-- grid column -->
                <div class="col-lg-8">
                    <!-- .card -->
                    <div class="card card-fluid">
                        <h6 class="card-header"> Mot de passe </h6><!-- .card-body -->
                        <div class="card-body">
                            <!-- form -->
                            <form method="post" action="{{ route('profile.updatePassword', Auth::user()->id) }}">
                                @method('PUT')
                                @csrf
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <div class="col-md-6 mb-3">
                                        <label for="input01">Nouveau mot de passe <abbr title="Required">*</abbr></label>
                                        <input type="password" class="form-control" id="input01" name="newPassword"
                                            placeholder="Taper le nouveau mot de passe" required="">
                                        @error('newPassword')
                                            <div class="">
                                                {{ $errors->first('newPassword') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-6 mb-3">
                                        <label for="input02">Confirmation du nouveau mot de passe <abbr
                                                title="Required">*</abbr></label> <input type="password"
                                            class="form-control" id="input02" name="newPassword_confirmation"
                                            placeholder="Retaper le nouveau mot de passe" required="">
                                        @error('newPassword_confirmation')
                                            <div class="">
                                                {{ $errors->first('newPassword_confirmation') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <hr>
                                <!-- .form-actions -->
                                <div class="form-actions">
                                    <!-- enable submit btn when user type their current password -->
                                    <input type="password" class="form-control mr-3" id="input06"
                                        placeholder="Taper le mot de passe actuel" name="oldPassword" required="">
                                    <button type="submit" class="btn btn-primary text-nowrap ml-auto">Approuver le
                                        changement</button>
                                </div><!-- /.form-actions -->
                            </form><!-- /form -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /grid column -->
            </div><!-- /grid row -->
        </div><!-- /.page-section -->
    </div><!-- /.page-inner -->
@endsection
