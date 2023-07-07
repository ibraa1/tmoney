@extends('layouts.body')
@section('title', 'Demander une compense | TMoney')
@section('content')
    <header class="page-title-bar">
        <!-- .breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('compenses.index') }}"><i
                            class="breadcrumb-icon fa fa-angle-left mr-2"></i>compenses</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        {{-- <button type="button" class="btn btn-success btn-floated"><span class="fa fa-plus"></span></button> --}}
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Demander une compense </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <div class="page-section">
        <!-- grid row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- .card -->
                <div class="card card-fluid">
                    <div class="card-header">
                        <h6 class=""> Balance : {{ Auth::user()->balances[0]->montant }}
                            {{ Auth::user()->balances[0]->detailBalance->devise->deviseEntree }} </h6>
                        <h6 class=""> Commision totale : {{ Auth::user()->balances[0]->montantTotalComission }}
                            {{ Auth::user()->balances[0]->detailBalance->devise->deviseEntree }} </h6>
                    </div>
                    <!-- .card-body -->
                    <div class="card-body">
                        <!-- form -->
                        <form method="POST" action="{{ route('compenses.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Montant <abbr title="Required">*</abbr></label> </label>
                                    <input type="text" class="form-control" required id="input01"
                                        value="{{ old('montant') }}" name="montant">
                                    @error('montant')
                                        <div class="">
                                            {{ $errors->first('montant') }}
                                        </div>
                                    @enderror

                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Devise <abbr title="Required">*</abbr></label> </label>
                                    <select name="deviseId" id="bss3" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="">Sélectionner une devise</option>
                                        @foreach ($devises as $devise)
                                            <option value="{{ $devise->id }}">{{ $devise->deviseEntree }} vers
                                                {{ $devise->deviseSortie }}
                                        @endforeach
                                    </select>

                                    </select>
                                    @error('deviseId')
                                        <div class="">
                                            {{ $errors->first('deviseId') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Type <abbr title="Required">*</abbr></label>
                                    </label>
                                    <select name="type" id="bss3" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="">Sélectionner un type</option>
                                        <option value="retraitBalance">Retrait Balance</option>
                                         <option value="transfertBalance">Transfert Balance</option>
                                        <option value="commission">Commission</option>
                                    </select>
                                    @error('type')
                                        <div class="">
                                            {{ $errors->first('type') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Mode de paiement <abbr title="Required">*</abbr></label>
                                    </label>
                                    <select name="modePaiement" id="bss3" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="">Sélectionner un mode de paiement</option>
                                        <option value="espèce">Espèce</option>
                                        <option value="mobileMoney">Mobile Money</option>
                                        <option value="transfert">Transfert</option>
                                        <option value="balance">Balance</option>
                                        <option value="autres">Autres</option>
                                    </select>
                                    @error('modePaiement')
                                        <div class="">
                                            {{ $errors->first('modePaiement') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Date<abbr title="Required">*</abbr></label> </label>
                                    <input type="datetime-local" class="form-control" required id="input01"
                                        value="{{ date('Y-m-d\TH:i') }}" name="dateInitiation">
                                    @error('dateInitiation')
                                        <div class="">
                                            {{ $errors->first('dateInitiation') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->

                            </div><!-- /form row -->

                            <!-- .form-group -->

                            <hr>
                            <div class="form-actions">
                                <!-- enable submit btn when compense type their current password -->
                                <button type="submit" class="btn btn-primary text-nowrap ml-auto">Demander une
                                    compense</button>
                            </div><!-- /.form-actions -->



                        </form><!-- /form -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /grid column -->
        </div><!-- /grid row -->
    </div>
@endsection
