@extends('layouts.body')
@section('title', 'Faire un transfert | TMoney')
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
                    <a href="{{ route('transactions.index') }}"><i
                            class="breadcrumb-icon fa fa-angle-left mr-2"></i>transactions</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        {{-- <button type="button" class="btn btn-success btn-floated"><span class="fa fa-plus"></span></button> --}}
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Faire un transfert</h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <!-- .page-section -->
    <div class="page-section">
        <!-- .section-block -->
        <div class="section-block">
            <!-- Default Steps -->
            <!-- .bs-stepper -->
            <div id="stepper" class="bs-stepper">
                <!-- .card -->
                <div class="card">
                    <!-- .card-header -->
                    <div class="card-header">
                        <!-- .steps -->
                        <div class="steps steps-" role="tablist">
                            <ul>
                                <li class="step" data-target="#test-l-1" data-validate="fieldset01">
                                    <a href="#" class="step-trigger" tabindex="-1"><span
                                            class="step-indicator step-indicator-icon"><i class="oi oi-person"></i></span>
                                        <span class="d-none d-sm-inline">Expéditeur</span></a>
                                </li>
                                <li class="step" data-target="#test-l-2" data-validate="fieldset02">
                                    <a href="#" class="step-trigger" tabindex="-1"><span
                                            class="step-indicator step-indicator-icon"><i class="oi oi-person"></i></span>
                                        <span class="d-none d-sm-inline">Destinataire</span></a>
                                </li>
                                <li class="step" data-target="#test-l-3" data-validate="fieldset03">
                                    <a href="#" class="step-trigger" tabindex="-1"><span
                                            class="step-indicator step-indicator-icon"><i
                                                class="oi oi-credit-card"></i></span> <span
                                            class="d-none d-sm-inline">Paiement</span></a>
                                </li>
                                <li class="step" data-target="#test-l-4" data-validate="agreement">
                                    <a href="#" class="step-trigger" tabindex="-1"><span
                                            class="step-indicator step-indicator-icon"><i class="oi oi-check"></i></span>
                                        <span class="d-none d-sm-inline">Confirmation</span></a>
                                </li>
                            </ul>
                        </div><!-- /.steps -->
                    </div><!-- /.card-header -->
                    <!-- .card-body -->
                    <div class="card-body">
                        <form id="stepper-form" name="stepperForm" method="POST" action="{{ route('transactions.store') }}"
                            class="p-lg-4 p-sm-3 p-0">
                            @csrf
                            <input type="hidden" name="type" value="transfert">
                            <!-- .content -->
                            <div id="test-l-1" class="content dstepper-none fade">
                                <input type="hidden" id="clientId" name="clientId">
                                <!-- fieldset -->
                                <!-- .page-inner -->
                                <div class="card-header">
                                    <!-- .nav-tabs -->
                                    Selectionner un client ou <button type="button" data-toggle="modal"
                                        data-target="#clientNewModal" class="btn btn-secondary">ajouter un
                                        client</button> avant de le selectionner
                                </div><!-- /.card-header -->
                                <div class="page-inner">
                                    <header class="page-navs bg-light shadow-sm">
                                        <!-- .input-group -->
                                        <div class="input-group has-clearable">
                                            <button type="button" class="close" aria-label="Close"><span
                                                    aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                                            <label class="input-group-prepend" for="searchClients"><span
                                                    class="input-group-text"><span
                                                        class="oi oi-magnifying-glass"></span></span></label> <input
                                                type="text" class="form-control" id="searchClients"
                                                data-filter=".list-group-item" placeholder="Chercher clients">
                                        </div><!-- /.input-group -->

                                    </header>
                                    {{-- <button type="button" class="btn btn-primary btn-floated position-absolute"
                                        data-toggle="modal" data-target="#clientNewModal" title="Add new client"><i
                                            class="fa fa-plus"></i></button> --}}
                                    <!-- board -->
                                    <div class="p-0 perfect-scrollbar">
                                        <!-- .list-group -->
                                        <div class="userList"
                                            class="list-group list-group-flush list-group-divider border-top"
                                            data-toggle="radiolist">
                                            @foreach ($clients as $client)
                                                <div class="list-group-item" id="1" data-toggle="sidebar"
                                                    data-sidebar="show" data-id="{{ $client->id }}">
                                                    <a href="#" class="stretched-link"></a>
                                                    <div class="list-group-item-figure">
                                                        <div class="tile tile-circle bg-indigo">
                                                            {{ substr($client->nom, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div class="list-group-item-body">
                                                        <h4 class="list-group-item-title">{{ $client->prenom }}
                                                            {{ $client->nom }} ({{ $client->numero_tel }})</h4>
                                                        <p class="list-group-item-text">{{ $client->ville->nom }},
                                                            {{ $client->pays->nom }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div><!-- /.list-group -->
                                    </div><!-- /board -->
                                </div>
                                <hr class="mt-5">
                                <!-- .d-flex -->
                                <div class="d-flex">
                                    <button type="button" class="next btn btn-primary ml-auto"
                                        data-validate="fieldset01">Suivant</button>
                                </div><!-- /.d-flex -->
                                <!-- /.page-inner -->
                            </div><!-- /.content -->
                            <!-- .content -->
                            <div id="test-l-2" class="content dstepper-none fade">
                                <input type="hidden" id="receveurId" name="receveurId">
                                <!-- fieldset -->
                                <!-- .page-inner -->
                                <div class="card-header">
                                    <!-- .nav-tabs -->
                                    Selectionner un destinataire ou <button type="button" data-toggle="modal"
                                        data-target="#clientNewModal" class="btn btn-secondary">ajouter un
                                        destinataire</button> avant de le selectionner
                                </div><!-- /.card-header -->
                                <div class="page-inner">
                                    <header class="page-navs bg-light shadow-sm">
                                        <!-- .input-group -->
                                        <div class="input-group has-clearable">
                                            <button type="button" class="close" aria-label="Close"><span
                                                    aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                                            <label class="input-group-prepend" for="searchClients"><span
                                                    class="input-group-text"><span
                                                        class="oi oi-magnifying-glass"></span></span></label> <input
                                                type="text" class="form-control" id="searchClients"
                                                data-filter=".board .list-group-item" placeholder="Chercher destinataire">
                                        </div><!-- /.input-group -->

                                    </header>
                                    {{-- <button type="button" class="btn btn-primary btn-floated position-absolute"
                                        data-toggle="modal" data-target="#clientNewModal" title="Add new client"><i
                                            class="fa fa-plus"></i></button> --}}
                                    <!-- board -->
                                    <div class="p-0 perfect-scrollbar">
                                        <!-- .list-group -->
                                        <div class="userList"
                                            class="list-group list-group-flush list-group-divider border-top"
                                            data-toggle="radiolist">
                                            @foreach ($clients as $client)
                                                <div class="list-group-item" id="2" data-toggle="sidebar"
                                                    data-sidebar="show" data-id="{{ $client->id }}">
                                                    <a href="#" class="stretched-link"></a>
                                                    <div class="list-group-item-figure">
                                                        <div class="tile tile-circle bg-indigo">
                                                            {{ substr($client->nom, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div class="list-group-item-body">
                                                        <h4 class="list-group-item-title">{{ $client->prenom }}
                                                            {{ $client->nom }} ({{ $client->numero_tel }})</h4>
                                                        <p class="list-group-item-text">{{ $client->ville->nom }},
                                                            {{ $client->pays->nom }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div><!-- /.list-group -->
                                    </div><!-- /board -->
                                </div>
                                <hr class="mt-5">
                                <!-- .d-flex -->
                                <div class="d-flex">
                                    <button type="button" class="prev btn btn-secondary">Précédent</button>
                                    <button type="button" id="suivant" class="next btn btn-primary ml-auto"
                                        data-validate="fieldset01">Suivant</button>
                                </div><!-- /.d-flex -->
                                <!-- /.page-inner -->
                            </div><!-- /.content -->
                            <!-- .content -->
                            <div id="test-l-3" class="content dstepper-none fade">
                                <!-- fieldset -->
                                <fieldset>
                                    <legend>Informations de transfert</legend> <!-- .custom-control -->
                                    @csrf
                                    <!-- form row -->
                                    <div class="form-row">
                                        <!-- form column -->
                                        <div class="col-md-6 mb-3">
                                            <label for="input01">Montant <abbr title="Required">*</abbr></label>
                                            </label>
                                            <input type="string" class="form-control" required id="montant"
                                                value="{{ old('montant') }}" name="montant">
                                        </div><!-- /form column -->
                                        <!-- form column -->
                                        <div class="col-md-6 mb-3">
                                            <label for="input02">Devise <abbr title="Required">*</abbr></label>
                                            </label>
                                            <select name="devise" id="devise" data-toggle="selectpicker" required
                                                data-live-search="true" data-width="100%">
                                                <option value="">Sélectionner une devise</option>

                                            </select>
                                        </div><!-- /form column -->
                                    </div><!-- /form row -->
                                    <div class="form-row">
                                        <!-- form column -->
                                        <div class="col-md-6 mb-3">
                                            <label for="input01">Type de Remise <abbr title="Required">*</abbr></label>
                                            </label>
                                            <select name="typeRemise" id="typeRemise" data-toggle="selectpicker" required
                                                data-live-search="true" data-width="100%">
                                                <option value="">Sélectionner un type de remise</option>
                                                <option value="aucun" selected>Aucune</option>
                                                <option value="pourcentage">Pourcentage</option>
                                                <option value="valeur">Valeur</option>
                                            </select>
                                        </div><!-- /form column -->
                                        <!-- form column -->
                                        <div class="col-md-6 mb-3">
                                            <label for="input02">Remise <abbr title="Required">*</abbr></label> </label>
                                            <input type="" class="form-control" value="{{ old('remise') }}"
                                                id="remise" name="remise">

                                        </div><!-- /form column -->
                                    </div><!-- /form row -->
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="input01">Pays <abbr title="Required">*</abbr></label>
                                            </label>
                                            <select name="paysId" id="bss3" data-toggle="selectpicker" required
                                                data-live-search="true" data-width="100%">
                                                <option value="">Sélectionner un pays</option>
                                                @foreach ($pays as $country)
                                                    <option value="{{ $country->id }}"
                                                        @if ($country->id === Auth::user()->pays_id) selected @endif>
                                                        {{ $country->nom }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- form column -->
                                        <div class="col-md-6 mb-3">
                                            <label for="input01">Date <abbr title="Required">*</abbr></label>
                                            </label>
                                            <input type="datetime-local" class="form-control" required id="input01"
                                                value="{{ date('Y-m-d\TH:i') }}" name="date">
                                        </div><!-- /form column -->
                                        <!-- form column -->

                                    </div><!-- /form row -->
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="input01">Montant définitif</label>
                                            </label>
                                            <input type="string" readonly class="form-control" required id="montantDef"
                                                name="montantDef">
                                        </div>

                                    </div><!-- /form row -->
                                    <hr class="mt-5">
                                    <div class="d-flex">
                                        <button type="button" class="prev btn btn-secondary">Précédent</button> <button
                                            type="button" class="next btn btn-primary ml-auto"
                                            data-validate="fieldset03">Suivant</button>
                                    </div>
                                </fieldset><!-- /fieldset -->
                            </div><!-- /.content -->
                            <!-- .content -->
                            <div id="test-l-4" class="content dstepper-none fade">
                                <!-- fieldset -->
                                <fieldset>
                                    <legend>Confirmation</legend> <!-- .card -->
                                    <div class="card bg-light">
                                        <div class="card-body overflow-auto" style="height: 140px">
                                            <p> Nous tenons à vous informer qu'une transaction a été initiée sur votre
                                                compte. Veuillez prendre note que cette opération est irréversible et
                                                qu'elle entraînera un transfert de fonds définitif.
                                                Nous vous prions de bien vouloir confirmer cette transaction en cliquant sur
                                                la case à cocher à la fin de ce message.
                                                Nous tenons à souligner qu'une fois la transaction confirmée, les fonds
                                                seront transférés et l'opération ne pourra pas être annulée. Il est donc
                                                essentiel de vérifier attentivement toutes les informations avant de
                                                procéder à la confirmation.

                                                Nous vous remercions de votre attention et de votre confiance.
                                            </p>
                                        </div>
                                    </div><!-- /.card -->
                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <!-- .custom-control -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="agreement" name="agreement"
                                                class="custom-control-input" data-parsley-group="agreement"
                                                required=""> <label class="custom-control-label"
                                                for="agreement">Confirmer</label>
                                        </div><!-- /.custom-control -->
                                    </div><!-- /.form-group -->
                                    <hr class="mt-5">
                                    <div class="d-flex">
                                        <button type="button" class="prev btn btn-secondary">Precedent</button>
                                        <button id="" type="submit" class="btn btn-primary ml-auto">Suivant
                                        </button>
                                        {{-- <button id="submitBtn" class="btn btn-primary ml-auto" type="submit">
                                            <span class="spinner-border spinner-border-sm d-none" role="status"
                                                aria-hidden="true"></span>
                                            <span id="btnText">Sauvegarder</span>
                                        </button> --}}
                                    </div>
                                </fieldset><!-- /fieldset -->
                            </div><!-- /.content -->
                        </form><!-- /form -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.bs-stepper -->
            <!-- toasts container -->
            <div aria-live="polite" aria-atomic="true">
                <!-- Position it -->
                <div style="position: fixed; top: 4.5rem; right: 1rem; z-index: 1050">
                    <!-- .toast -->
                    <div id="submitfeedback" class="toast bg-dark border-dark text-light fade hide" data-delay="3000"
                        role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-primary text-white"> See your browser console </div>
                        <div class="toast-body">
                            <strong>Congrats!</strong> You see the submit feedback.
                        </div>
                    </div><!-- /.toast -->
                </div>
            </div><!-- /toasts container -->
        </div><!-- /.section-block -->
    </div><!-- /.page-section -->
@endsection


<form id="clientNewForm" name="clientNewForm">
    <div class="modal fade" id="clientNewModal" tabindex="-1" role="dialog" aria-labelledby="clientNewModalLabel"
        aria-hidden="true">
        <!-- .modal-dialog -->
        <div class="modal-dialog" role="document">
            <!-- .modal-content -->
            <div class="modal-content">
                <!-- .modal-header -->
                <div class="modal-header">
                    <h6 id="clientNewModalLabel" class="modal-title inline-editable">
                        <span class="">Ajout</span>
                    </h6>
                </div><!-- /.modal-header -->
                <!-- .modal-body -->
                <div class="modal-body">
                    <!-- .form-row -->
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cnContactName">Nom</label> <input required type="text" name="nom"
                                    id="cnContactName" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cnContactName">Prenom</label> <input required name="prenom"
                                    type="text" id="cnContactName" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cnContactName">Telephone</label> <input required type="text"
                                    name="telephone" id="cnContactName" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cnContactEmail">Email</label> <input required type="email"
                                    name="email" id="cnContactEmail" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cnCountry">Pays</label>
                                <select required id="paysId" name="pays" class="custom-select d-block w-100">
                                    <option value=""> Choisis... </option>
                                    @foreach ($pays as $country)
                                        <option value="{{ $country->id }}">{{ $country->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cnCity">Ville</label>
                                <select required id="ville" name="ville" class="custom-select d-block w-100">
                                    <option value=""> Choisis... </option>
                                </select>
                            </div>
                        </div>
                    </div><!-- /.form-row -->
                </div><!-- /.modal-body -->
                <!-- .modal-footer -->
                <div class="modal-footer">
                    <button id="submitBtn" class="btn btn-primary" type="submit">
                        <span class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
                        <span id="btnText">Sauvegarder</span>
                    </button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                </div><!-- /.modal-footer -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</form><!-- /.modal -->
