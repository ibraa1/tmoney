@extends('layouts.body')
@section('title', 'Convertir un devise | TMoney')
@section('content')
    <header class="page-title-bar">
        <!-- .breadcrumb -->

        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Convertir une devise </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <div class="page-section">
        <!-- grid row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- .card -->
                <div class="card card-fluid">
                    <h6 class="card-header"> Devise </h6><!-- .card-body -->
                    <div class="card-body">
                        <!-- form -->
                        <form method="POST" action="{{ route('devises.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Montant <abbr title="Required">*</abbr></label> </label>
                                    <input type="montant" class="form-control" required id="montant"
                                        value="{{ old('montant') }}" name="montant">
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Devise <abbr title="Required">*</abbr></label> </label>
                                    <select name="devise" id="devise" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="">Sélectionner une devise</option>
                                        @foreach ($devises as $devise)
                                            <option value="{{ $devise->id }}">{{ $devise->deviseEntree }} en
                                                {{ $devise->deviseSortie }}</option>
                                        @endforeach
                                    </select>


                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <!-- .form-group -->

                            <hr>
                            <div class="form-actions">
                                <!-- enable submit btn when devise type their current password -->
                                <button type="submit" id="deviseCalcul"
                                    class="btn btn-primary text-nowrap ml-auto">Convertir devise</button>
                            </div><!-- /.form-actions -->



                        </form><!-- /form -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /grid column -->
        </div><!-- /grid row -->
    </div>
@endsection
