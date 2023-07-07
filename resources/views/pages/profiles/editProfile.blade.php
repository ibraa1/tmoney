@extends('layouts.body')
@section('title', 'Modifier le profil | TMoney')
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
                                class="nav-link">Mot de passe</a> <a href="#" class="nav-link active">Informations de
                                profil</a>
                        </nav><!-- /.nav -->
                    </div><!-- /.card -->
                </div><!-- /grid column -->
                <!-- grid column -->
                <div class="col-lg-8">
                    <!-- .card -->
                    <div class="card card-fluid">
                        <h6 class="card-header">Informations de profil</h6><!-- .card-body -->
                        <div class="card-body">
                            <!-- form -->
                            <form method="post" action="{{ route('profile.update', Auth::user()->id) }}">
                                @method('PUT')
                                @csrf
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="input01" class="col-md-3">Nom <abbr title="Required">*</abbr></label>
                                    <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" class="form-control" name="nom" id="input01"
                                            value="{{ Auth::user()->nom }}" required="">
                                        @error('nom')
                                            <div class="">
                                                {{ $errors->first('nom') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="input02" class="col-md-3">Prenom <abbr title="Required">*</abbr></label>
                                    <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" class="form-control" id="input02" name="prenom"
                                            value="{{ Auth::user()->prenom }}" required="">
                                        @error('prenom')
                                            <div class="">
                                                {{ $errors->first('prenom') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="input01" class="col-md-3">Email <abbr title="Required">*</abbr></label>
                                    <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" class="form-control" name="email" id="input01"
                                            value="{{ Auth::user()->email }}" required="">
                                        @error('email')
                                            <div class="">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="input02" class="col-md-3">Telephone <abbr title="Required">*</abbr></label>
                                    <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" class="form-control" id="input02" name="numero_tel"
                                            value="{{ Auth::user()->numero_tel }}" required="">
                                        @error('numero_tel')
                                            <div class="">
                                                {{ $errors->first('numero_tel') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="input05" class="col-md-3">Addresse <abbr
                                            title="Required">*</abbr></label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="adresse" class="form-control"
                                            value="{{ Auth::user()->adresse }}" id="input05">
                                        @error('adresse')
                                            <div class="">
                                                {{ $errors->first('adresse') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="input08" class="col-md-3">Role <abbr title="Required">*</abbr></label>
                                    <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <select name="role" id="bss3" data-toggle="selectpicker"
                                            data-live-search="true" data-width="100%"
                                            @if (auth()->user()->role == 'client') disabled @endif>
                                            <option value="">Sélectionner un rôle</option>
                                            <option value="agent" {{ $user->role === 'agent' ? 'selected' : '' }}>Agent
                                            </option>
                                            <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client
                                            </option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="superAdmin"
                                                {{ $user->role === 'superAdmin' ? 'selected' : '' }}>
                                                Super administrateur</option>
                                        </select>
                                        @error('role')
                                            <div class="">
                                                {{ $errors->first('role') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="input06" class="col-md-3">Pays <abbr title="Required">*</abbr></label>
                                    <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <select onchange="getVillesByPays(this->value)" name="pays" id="paysId"
                                            data-toggle="selectpicker" data-live-search="true" data-width="100%">
                                            <option value="">Sélectionner un pays</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ $user->pays_id === $country->id ? 'selected' : '' }}>
                                                    {{ $country->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pays')
                                            <div class="">
                                                {{ $errors->first('pays') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="input07" class="col-md-3">Ville <abbr title="Required">*</abbr></label>
                                    <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <select name="ville" id="ville" data-toggle="selectpicker"
                                            data-live-search="true" data-width="100%">
                                            <option value="">Sélectionner une ville</option>
                                            @foreach ($villes as $ville)
                                                <option value="{{ $ville->id }}"
                                                    {{ $user->ville_id === $ville->id ? 'selected' : '' }}>
                                                    {{ $ville->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('ville')
                                            <div class="">
                                                {{ $errors->first('ville') }}
                                            </div>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <hr class="my-4">
                                <!-- .form-actions -->
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary ml-auto">Approuver les
                                        changements</button>
                                </div><!-- /.form-actions -->
                            </form><!-- /form -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /grid column -->
            </div><!-- /grid row -->
        </div><!-- /.page-section -->
    </div><!-- /.page-inner -->
@endsection
