@extends('layouts.body')
@section('title', 'Faire un retrait | TMoney')
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
            <h1 class="page-title mr-sm-auto"> Faire un retrait</h1><!-- .btn-toolbar -->
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
                        <h6 class="">
                            Balance :
                            @php
                                $latestBalance = Auth::user()
                                    ->balances()
                                    ->latest('created_at')
                                    ->first();
                            @endphp

                            @if ($latestBalance)
                                {{ number_format($latestBalance->montant, 2, ',', ' ') }}
                                {{ $latestBalance->detailBalance->devise->deviseEntree }}
                            @endif
                        </h6>
                        <h6 class="">
                            Commision totale :
                            @php
                                $latestBalance = Auth::user()
                                    ->balances()
                                    ->latest('created_at')
                                    ->first();
                            @endphp

                            @if ($latestBalance)
                                {{ number_format($latestBalance->montantTotalComission, 2, ',', ' ') }}
                                {{ $latestBalance->detailBalance->devise->deviseEntree }}
                            @endif
                        </h6>
                        <!-- .steps -->
                        <div class="steps steps-" role="tablist">
                            <ul>
                                <li class="step" data-target="#test-l-1">
                                    <a href="#" class="step-trigger" tabindex="-1"><span
                                            class="step-indicator step-indicator-icon"><i class="oi oi-person"></i></span>
                                        <span class="d-none d-sm-inline">Code</span></a>
                                </li>

                                <li class="step" data-target="#test-l-4">
                                    <a href="#" class="step-trigger" tabindex="-1"><span
                                            class="step-indicator step-indicator-icon"><i class="oi oi-check"></i></span>
                                        <span class="d-none d-sm-inline">Confirmation</span></a>
                                </li>
                            </ul>
                        </div><!-- /.steps -->
                    </div><!-- /.card-header -->
                    <!-- .card-body -->
                    <div class="card-body">
                        <form id="stepper-form" name="stepperForm" method="POST" action="{{ route('addRetrait') }}"
                            class="p-lg-4 p-sm-3 p-0">
                            @csrf
                            <!-- .content -->
                            <div id="test-l-1" class="content dstepper-none fade">
                                <!-- .card -->
                                <div class="card">
                                    <div class="card-header d-flex">
                                        <div class="form-group col-md-6 mb-3">

                                            <div class="has-clearable">
                                                <button type="button" class="close" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-times-circle"></i>
                                                    </span>
                                                </button> <input type="text" class="form-control" name="code"
                                                    id="code" placeholder="Entrer le code">
                                            </div>
                                        </div>
                                        <button id="submitButton" class="btn btn-primary" type="">
                                            <span class="spinner-border spinner-border-sm d-none" role="status"
                                                aria-hidden="true"></span>
                                            <span id="btnTexte">Recherche</span>
                                        </button>
                                    </div>
                                    <!-- .card-body -->
                                    <div class="card-body">
                                        <h3 class="card-title"> Informations du retrait </h3><!-- form .needs-validation -->
                                        <form class="needs-validation" novalidate="">
                                            <!-- .form-row -->
                                            <div class="form-row">
                                                <!-- form grid -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01">Envoyeur <abbr
                                                            title="Required">*</abbr></label>
                                                    <select class="custom-select d-block w-100" id="clientId"
                                                        name="clientId" required="">
                                                        <option value=""> Choisis... </option>

                                                    </select>

                                                </div><!-- /form grid -->
                                                <!-- form grid -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip02">Destinataire <abbr
                                                            title="Required">*</abbr></label> <select
                                                        class="custom-select d-block w-100" id="receveurId"
                                                        name="receveurId" required="">
                                                        <option value=""> Choisis... </option>

                                                    </select>

                                                </div><!-- /form grid -->
                                                <!-- form grid -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltipUsername">Montant <abbr
                                                            title="Required">*</abbr></label> <input readonly type="text"
                                                        class="form-control" name="montant" id="montant"
                                                        placeholder="Montant" aria-describedby="inputGroupPrepend"
                                                        required="">

                                                </div><!-- /form grid -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltipState">Devise <abbr
                                                            title="Required">*</abbr></label> <select
                                                        class="custom-select d-block w-100" id="devise" name="devise"
                                                        required="">
                                                        <option value=""> Choisis... </option>

                                                    </select>

                                                </div>
                                                <input type="hidden" id="transacId" name="transacId">
                                            </div><!-- /.form-row -->
                                            <!-- .form-row -->
                                            <div class="form-row">
                                                <!-- grid column -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltipCountry">Pays <abbr
                                                            title="Required">*</abbr></label> <select
                                                        class="custom-select d-block w-100" id="paysId" name="paysId"
                                                        required="">
                                                        <option value=""> Choisis... </option>

                                                    </select>

                                                </div><!-- /grid column -->
                                                <!-- grid column -->

                                                <!-- grid column -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltipZip">Date <abbr
                                                            title="Required">*</abbr></label> <input readonly
                                                        type="datetime-local" value="{{ date('Y-m-d\TH:i') }}"
                                                        class="form-control" id="date" name="date"
                                                        required="">

                                                </div><!-- /grid column -->
                                            </div><!-- /.form-row -->


                                            <!-- .form-actions -->

                                        </form><!-- /form .needs-validation -->
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->

                                <hr class="mt-5">
                                <!-- .d-flex -->
                                <div class="d-flex">
                                    <button type="button" class="next btn btn-primary ml-auto"
                                        data-validate="fieldset01">Suivant</button>
                                </div><!-- /.d-flex -->
                                <!-- /.page-inner -->
                            </div><!-- /.content -->
                            <!-- .content -->
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
                                                required="">
                                            <label class="custom-control-label" for="agreement">Confirmer</label>
                                        </div><!-- /.custom-control -->
                                    </div><!-- /.form-group -->
                                    <hr class="mt-5">
                                    <div class="d-flex">
                                        <button type="button" class="prev btn btn-secondary">Precedent</button>
                                        <button id="submitButton2" type="submit" class="btn btn-primary ml-auto">Suivant
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
