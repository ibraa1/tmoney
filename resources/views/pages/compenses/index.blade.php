@extends('layouts.body')
@section('title', 'Liste des compenses | TMoney')
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
    <header class="page-title-bar">
        <!-- .breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Compenses</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        <a href="{{ route('compenses.create') }}"><button type="button" class="btn btn-success btn-floated"><span
                    class="fa fa-plus"></span></button></a>
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Liste des compenses </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <!-- .page-section -->
    <div class="page-section">
        <!-- .card -->
        <div class="card card-fluid">
            <!-- .card-header -->
            @if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superAdmin')
                <div class="card-header">
                    <!-- .nav-tabs -->
                    <a href="{{ route('compenses.create') }}"><button type="button" class="btn btn-primary">Demander une
                            compense</button></a>
                </div><!-- /.card-header -->
            @endif
            <!-- .card-body -->
            <div class="card-body">
                <!-- .form-group -->
                <div class="form-group">
                    <!-- .input-group -->
                    <div class="input-group input-group-alt">
                        <!-- .input-group-prepend -->
                        <div class="input-group-prepend">
                            <select id="filterBy" class="custom-select">
                                <option value='' selected> Filtrer par </option>
                                <option value="0"> Agent </option>
                                <option value="1"> Montant </option>
                                <option value="2"> Date </option>
                                <option value="3"> Statut </option>
                                <option value="4"> Type </option>
                                <option value="5"> Mode de paiement </option>
                            </select>
                        </div><!-- /.input-group-prepend -->
                        <!-- .input-group -->
                        <div class="input-group has-clearable">
                            <button id="clear-search" type="button" class="close" aria-label="Close"><span
                                    aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
                            </div><input id="table-search" type="text" class="form-control" placeholder="Rechercher">
                        </div><!-- /.input-group -->
                    </div><!-- /.input-group -->
                </div><!-- /.form-group -->
                <!-- .table -->
                <table id="myTable" class="table">
                    <!-- thead -->
                    <thead>
                        <tr>
                            <th>Agent</th>
                            <th> Montant </th>
                            <th> Date D'initiation </th>
                            <th> Date D'approbation</th>
                            <th> Statut </th>
                            <th> Type </th>
                            <th> Mode de paiement </th>
                            <th> Actions </th>

                        </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                        <!-- create empty row to passing html validator -->
                        @foreach ($compenses as $compense)
                            <tr>
                                <td>{{ $compense->user->prenom }} {{ $compense->user->nom }}</td>
                                <td>{{ $compense->detailCompenses[0]->montant }}
                                    {{ $compense->detailCompenses[0]->devise->deviseSortie }}</td>
                                <td>{{ $compense->dateInitiation }}</td>
                                <td>{{ $compense->dateApprobation }}</td>
                                <td>{{ Str::ucfirst($compense->statut) }}</td>
                                <td>{{ Str::ucfirst($compense->detailCompenses[0]->type) }}</td>
                                <td>{{ Str::ucfirst($compense->detailCompenses[0]->modePaiement) }}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        @if (Auth::user()->role == 'admin')
                                            @if ($compense->statut == 'en attente')
                                                <form id=""
                                                    action="{{ route('compenses.approve', $compense->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button class="btn btn-sm btn-icon btn-secondary"
                                                        onclick="return confirm('Voulez vous vraiment approuvé cette transaction ?')"
                                                        title="Approuvé">
                                                        <i class="fa fa-thumbs-up"></i>
                                                    </button>
                                                </form>
                                                <form id=""
                                                    action="{{ route('compenses.reject', $compense->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-sm btn-icon btn-secondary"
                                                        onclick="return confirm('Voulez vous vraiment réjeté cette transaction ?')"
                                                        title="Rejeté">
                                                        <i class="fa fa-ban"></i>
                                                    </button>
                                                </form>
                                            @endif




                                            @if ($compense->statut !== 'réjeté' && $compense->dateApprobation)
                                                <a class="btn btn-sm btn-icon btn-secondary"
                                                    href="{{ route('compenses.facture', $compense->id) }}">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            @endif

                                            @if (!$compense->deleted_at)
                                                <form id=""
                                                    action="{{ route('compenses.destroy', $compense->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button title="Supprimer"
                                                        onclick="return confirm('Voulez vous vraiment supprimer cette ligne')"
                                                        class="btn btn-sm btn-icon btn-secondary" href="#">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('compenses.restore', $compense->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button title="Restaurer"
                                                        onclick="return confirm('Voulez vous vraiment restaurer cette ligne')"
                                                        class="btn btn-sm btn-icon btn-secondary" href="#">
                                                        <i class="far fa-undo"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody><!-- /tbody -->
                </table><!-- /.table -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.page-section -->
@endsection
