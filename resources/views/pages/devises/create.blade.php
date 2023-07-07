@extends('layouts.body')
@section('title', 'Ajouter un devise | TMoney')
@section('content')
    <header class="page-title-bar">
        <!-- .breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('devises.index') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>devises</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        {{-- <button type="button" class="btn btn-success btn-floated"><span class="fa fa-plus"></span></button> --}}
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Ajouter une devise </h1><!-- .btn-toolbar -->
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
                                    <label for="input01">Frequence <abbr title="Required">*</abbr></label> </label>
                                    <select name="frequence" id="bss3" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="">Sélectionner une frequence</option>
                                        <option value="Quotidien">Quotidien</option>
                                        <option value="Mensuel"> Mensuel </option>
                                        <option value="Annuel"> Annuel </option>
                                    </select>
                                    @error('frequence')
                                        <div class="">
                                            {{ $errors->first('frequence') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Devise d'entrée <abbr title="Required">*</abbr></label> </label>
                                    <select name="deviseEntree" id="bss3" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="">Sélectionner une devise d'entrée</option>
                                        <option value="EURO">Euro</option>
                                        <option value="USD">Dollar</option>
                                        <option value="XOF">Franc CFA</option>
                                        <option value="GNF">Franc Guinéen</option>
                                        <option value="CAD">Dollar Canadien</option>
                                    </select>

                                    </select>
                                    @error('deviseEntree')
                                        <div class="">
                                            {{ $errors->first('deviseEntree') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Devise de sortie <abbr title="Required">*</abbr></label> </label>
                                    <select name="deviseSortie" id="bss3" data-toggle="selectpicker" required
                                        data-live-search="true" data-width="100%">
                                        <option value="">Sélectionner une devise de sortie</option>
                                        <option value="EURO">Euro</option>
                                        <option value="USD">Dollar</option>
                                        <option value="XOF">Franc CFA</option>
                                        <option value="GNF">Franc Guinéen</option>
                                        <option value="CAD">Dollar Canadien</option>
                                    </select>
                                    @error('deviseSortie')
                                        <div class="">
                                            {{ $errors->first('deviseSortie') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input02">Cour de la devise <abbr title="Required">*</abbr></label> </label>
                                    <input type="" class="form-control" required value="{{ old('courDevise') }}"
                                        id="input02" value="" name="courDevise">
                                    @error('courDevise')
                                        <div class="">
                                            {{ $errors->first('courDevise') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                            </div><!-- /form row -->
                            <div class="form-row">
                                <!-- form column -->
                                <div class="col-md-6 mb-3">
                                    <label for="input01">Date de debut <abbr title="Required">*</abbr></label> </label>
                                    <input type="date" class="form-control" required id="input01"
                                        value="{{ date('Y-m-d') }}" name="dateDebut">
                                    @error('dateDebut')
                                        <div class="">
                                            {{ $errors->first('dateDebut') }}
                                        </div>
                                    @enderror
                                </div><!-- /form column -->
                                <!-- form column -->

                            </div><!-- /form row -->

                            <!-- .form-group -->

                            <hr>
                            <div class="form-actions">
                                <!-- enable submit btn when devise type their current password -->
                                <button type="submit" class="btn btn-primary text-nowrap ml-auto">Ajouter une
                                    devise</button>
                            </div><!-- /.form-actions -->



                        </form><!-- /form -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /grid column -->
        </div><!-- /grid row -->
    </div>
@endsection
