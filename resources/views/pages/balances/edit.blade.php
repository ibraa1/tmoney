@extends('layouts.body')
@section('title', 'Modifier une balance | TMoney')
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
                    <a href="{{ route('balances.index') }}"><i
                            class="breadcrumb-icon fa fa-angle-left mr-2"></i>balances</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        {{-- <button type="button" class="btn btn-success btn-floated"><span class="fa fa-plus"></span></button> --}}
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Modifier une balance </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <div class="page-section">
        <!-- grid row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- .card -->
                <div class="card card-fluid">
                    <h6 class="card-header"> Balance </h6><!-- .card-body -->
                    <div class="card-body">
                        <!-- form -->
                        <form method="POST" action="{{ route('balances.update', $balance->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Minimum <abbr title="Required">*</abbr></label> </label> <input
                                        type="" class="form-control" required
                                        value="{{ $balance->detailBalance->min }}" id="input01" name="min">
                                    @error('min')
                                        <div class="">
                                            {{ $errors->first('min') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Maximum <abbr title="Required">*</abbr></label> </label>
                                    <input type="text" class="form-control" required id="input02"
                                        value="{{ $balance->detailBalance->max }}" name="max">
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
                                        type="" class="form-control" required value="{{ $balance->montant }}"
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
                                        class="form-control" required id="input02"
                                        value="{{ $balance->montantTotalComission }}" name="montantTotalComission">
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
                                            <option value="{{ $devise->id }}"
                                                {{ $balance->detailBalance->deviseId === $devise->id ? 'selected' : '' }}>
                                                {{ $devise->deviseEntree }}</option>
                                        @endforeach

                                    </select>
                                    @error('devise')
                                        <div class="">
                                            {{ $errors->first('devise') }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="userId" value="{{ $balance->userId }}"><!-- /form column -->
                            </div><!-- /form row -->

                            <hr>
                            <div class="form-actions">
                                <!-- enable submit btn when user type their current password -->
                                <button type="submit" class="btn btn-primary text-nowrap ml-auto">Modifier une
                                    balance</button>
                            </div><!-- /.form-actions -->

                        </form><!-- /form -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /grid column -->
        </div><!-- /grid row -->
    </div>
@endsection
