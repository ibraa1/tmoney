@extends('layouts.body')
@section('title', 'Modifier la photo profil | TMoney')
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
        <div class="alert alert-danger" style="border-radius: 4px; position: relative;">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                <i class="nc-icon nc-simple-remove"></i>
            </button>
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
            <div style="color:blueviolet">Balances: <br>
                @if (Auth::user()->role == 'agent')
                    @php
                        $latestBalance = Auth::user()
                            ->balances()
                            ->latest('created_at')
                            ->first();
                    @endphp

                    @if ($latestBalance)
                        {{ number_format($latestBalance->montant + $latestBalance->montantTotalComission, 2, ',', ' ') }}
                        {{ $latestBalance->detailBalance->devise->deviseEntree }}
                    @endif
                @else
                    @foreach (Auth::user()->balances as $balance)
                        {{ $balance->montant }} {{ $balance->detailBalance->devise->deviseEntree }}<br>
                    @endforeach
                @endif
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
                            <a href="#" class="nav-link active">Photo de profil</a> <a
                                href="{{ route('profile.editPassword', Auth::user()->id) }}" class="nav-link">Mot de
                                passe</a> <a href="{{ route('profile.edit', Auth::user()->id) }}"
                                class="nav-link">Informations de profil</a>
                        </nav><!-- /.nav -->
                    </div><!-- /.card -->
                </div><!-- /grid column -->
                <!-- grid column -->
                <div class="col-lg-8">
                    <!-- .card -->
                    <div class="card card-fluid">
                        <h6 class="card-header"> Photo de profil </h6><!-- .card-body -->
                        <div class="card-body">
                            <!-- form -->
                            <form method="post" action="{{ route('profilePicture.update', Auth::user()->id) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-row">
                                    {{-- <!-- .media -->
                                    <div class="media mb-3">
                                        <!-- avatar -->
                                        <div class="user-avatar user-avatar-xl fileinput-button">
                                            <div class="fileinput-button-label"> Changer la photo </div><img
                                                src="{{ asset(Auth::user()->image) }}" alt=""> <input
                                                id="fileupload-avatar" type="file" name="image">
                                        </div><!-- /avatar -->
                                        <!-- .media-body -->
                                        <div class="media-body pl-3">
                                            <h3 class="card-title"> Image </h3>
                                            <h6 class="card-subtitle text-muted"> Click sur la photo pour la changer.
                                            </h6>
                                            <p class="card-text">
                                                <small>JPG, GIF ou PNG 400x400, &lt; 2 MB.</small>
                                            </p><!-- The avatar upload progress bar -->
                                            <div id="progress-avatar" class="progress progress-xs fade">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div><!-- /avatar upload progress bar -->
                                        </div><!-- /.media-body -->
                                    </div><!-- /.media --> --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="control-label" for="">Image</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input"> <label
                                                class="custom-file-label" for="tfInvalid">Choisir une image</label>
                                            @error('image')
                                                <div class="">
                                                    {{ $errors->first('image') }}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <!-- .form-actions -->
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary ml-auto">Approuver le changement</button>
                                </div><!-- /.form-actions -->
                            </form><!-- /form -->
                            <hr>
                            <!-- form row -->

                            @if (Auth::user()->image !== 'images/users/defaultUserPicture.jpg')
                                <form action="{{ route('profilePicture.delete', Auth::user()->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="form-row">
                                        <button onclick="return confirm('Voulez vous vraiment supprimer votre photo ?')"
                                            type="submit" class="btn btn-danger ml-auto"><i class="fa fa-trash"
                                                aria-hidden="true"></i>&nbsp;Supprimer ma photo de
                                            Profil</button><!-- /form column -->
                                    </div><!-- /form row -->
                            @endif
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /grid column -->
            </div><!-- /grid row -->
        </div><!-- /.page-section -->
    </div><!-- /.page-inner -->
@endsection
