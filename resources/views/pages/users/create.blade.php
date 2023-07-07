@extends('layouts.body')
@section('title', 'Ajouter un utilisateur | TMoney')
@section('content')
    @if ($message = Session::get('error'))
        <div class="alert alert-danger" style="border-radius: 4px; position: relative;">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                <i class="nc-icon nc-simple-remove"></i>
            </button>
            <p>{{ $message }}</p>
        </div>
    @endif
    <header class="page-title-bar">
        <!-- .breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('users.index') }}"><i
                            class="breadcrumb-icon fa fa-angle-left mr-2"></i>Utilisateurs</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        {{-- <button type="button" class="btn btn-success btn-floated"><span class="fa fa-plus"></span></button> --}}
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Ajouter un utilisateur </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <div class="page-section">
        <!-- grid row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- .card -->
                <div class="card card-fluid">
                    <h6 class="card-header"> Compte </h6><!-- .card-body -->
                    <div class="card-body">
                        <!-- form -->
                        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Prenom <abbr title="Required">*</abbr></label> </label> <input
                                        type="text" class="form-control" required value="{{ old('prenom') }}"
                                        id="input01" name="prenom">
                                    @error('prenom')
                                        <div class="">
                                            {{ $errors->first('prenom') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Nom <abbr title="Required">*</abbr></label> </label> <input
                                        type="text" class="form-control" required id="input02"
                                        value="{{ old('nom') }}" name="nom">
                                    @error('nom')
                                        <div class="">
                                            {{ $errors->first('nom') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Email <abbr title="Required">*</abbr></label> </label> <input
                                        type="email" class="form-control" required id="input01"
                                        value="{{ old('email') }}" name="email">
                                    @error('email')
                                        <div class="">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Téléphone <abbr title="Required">*</abbr></label> </label> <input
                                        type="text" class="form-control" required value="{{ old('numero_tel') }}"
                                        id="input02" value="" name="numero_tel">
                                    @error('numero_tel')
                                        <div class="">
                                            {{ $errors->first('numero_tel') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Adresse <abbr title="Required">*</abbr></label> </label> <input
                                        type="text" class="form-control" required id="input01"
                                        value="{{ old('adresse') }}" name="adresse">
                                    @error('adresse')
                                        <div class="">
                                            {{ $errors->first('adresse') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="bss3">Rôle <abbr title="Required">*</abbr></label>
                                    </label>
                                    <select name="role" id="bss3" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="">Sélectionner un rôle</option>
                                        <option value="agent">Agent</option>
                                        <option value="client"> Client </option>
                                        <option value="admin"> Admin </option>
                                        <option value="superAdmin"> Super administrateur</option>
                                    </select>
                                    @error('role')
                                        <div class="">
                                            {{ $errors->first('role') }}
                                        </div>
                                    @enderror
                                </div><!-- /.form-group -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="bss3">Pays <abbr title="Required">*</abbr></label>
                                    </label>
                                    <select name="pays" id="paysId" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="" selected>Sélectionner un pays</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"> {{ $country->nom }} </option>
                                        @endforeach
                                    </select>
                                    @error('pays')
                                        <div class="">
                                            {{ $errors->first('pays') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="bss3">Ville <abbr
                                            title="Required">*</abbr></label> </label>
                                    <select name="ville" id="ville" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="" selected>Sélectionner une ville</option>

                                    </select>
                                    @error('ville')
                                        <div class="">
                                            {{ $errors->first('ville') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
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

                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Mot de passe <abbr title="Required">*</abbr></label> </label>
                                    <input name="password" type="password" class="form-control" required id="input02"
                                        value="">
                                    @error('password')
                                        <div class="">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- /form column -->
                            </div><!-- /form row -->
                            <!-- .form-group -->

                            <hr>
                            <h4 class="card-title"> Balance </h4><!-- .custom-control -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Minimum <abbr title="Required">*</abbr></label> </label> <input
                                        type="" class="form-control" required value="{{ old('min') }}"
                                        id="input01" name="min">
                                    @error('min')
                                        <div class="">
                                            {{ $errors->first('min') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Maximum <abbr title="Required">*</abbr></label> </label>
                                    <input type="text" class="form-control" required value="{{ old('max') }}"
                                        id="input02" name="max">
                                    @error('max')
                                        <div class="">
                                            {{ $errors->first('max') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Montant <abbr title="Required">*</abbr></label> </label> <input
                                        type="" class="form-control" required value="{{ old('montant') }}"
                                        id="input01" name="montant">
                                    @error('montant')
                                        <div class="">
                                            {{ $errors->first('montant') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Montant total de la commission <abbr
                                            title="Required">*</abbr></label> </label> <input type="text"
                                        class="form-control" readonly value="0" required id="input02"
                                        value="{{ old('montantTotalComission') }}" name="montantTotalComission">
                                    @error('nom')
                                        <div class="">
                                            {{ $errors->first('montantTotalComission') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="bss3">Devise <abbr
                                            title="Required">*</abbr></label> </label>
                                    <select name="devise" id="devise" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="" selected>Sélectionner une devise</option>
                                        @foreach ($devises as $devise)
                                            <option value="{{ $devise->id }}">
                                                {{ $devise->deviseEntree }}</option>
                                        @endforeach

                                    </select>
                                    @error('devise')
                                        <div class="">
                                            {{ $errors->first('devise') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <hr>
                            <div class="form-actions">
                                <!-- enable submit btn when user type their current password -->
                                <button type="submit" class="btn btn-primary text-nowrap ml-auto">Créer un
                                    compte</button>
                            </div><!-- /.form-actions -->

                        </form><!-- /form -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /grid column -->
        </div><!-- /grid row -->
    </div>
@endsection
