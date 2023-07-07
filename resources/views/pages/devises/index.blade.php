@extends('layouts.body')
@section('title', 'Liste des devises | TMoney')
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
                    <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Devises</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('devises.create') }}"><button type="button" class="btn btn-success btn-floated"><span
                        class="fa fa-plus"></span></button></a>
        @endif
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Liste des devises </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <!-- .page-section -->
    <div class="page-section">
        <!-- .card -->
        <div class="card card-fluid">
            <!-- .card-header -->
            @if (Auth::user()->role == 'admin')
                <div class="card-header">
                    <!-- .nav-tabs -->
                    <a href="{{ route('devises.create') }}"><button type="button" class="btn btn-primary">Ajouter une
                            devise</button></a>
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
                                <option value="0"> Frequence </option>
                                <option value="1"> Devise d'entrée </option>
                                <option value="2"> Devise de sortie </option>
                                <option value="3"> Cour de la devise </option>
                                <option value="4"> Date de debut </option>
                                <option value="5"> Date de fin </option>
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
                            <th>Frequence</th>
                            <th> Devise d'entrée </th>
                            <th> Devise de sortie </th>
                            <th> Cour de la devise </th>
                            <th> Date de debut </th>
                            <th> Date de fin </th>
                            <th> Actions </th>

                        </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                        <!-- create empty row to passing html validator -->
                        @foreach ($devises as $devise)
                            <tr>
                                <td>{{ $devise->frequence }}</td>
                                <td>{{ $devise->deviseEntree }}</td>
                                <td>{{ $devise->deviseSortie }}</td>
                                <td>{{ $devise->courDevise }}</td>
                                <td>{{ $devise->dateDebut }}</td>
                                <td>{{ $devise->dateFin }}</td>
                                <td>
                                    @if (Auth::user()->role == 'admin')
                                        <div class="d-flex justify-content-between">
                                            @if ($devise->deleted_at)
                                            @else
                                                @if (!$devise->dateFin)
                                                    <a class="btn btn-sm btn-icon btn-secondary"
                                                        href="{{ route('devises.edit', $devise->id) }}">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                @endif
                                            @endif

                                            @if (!$devise->deleted_at)
                                                <form id="" action="{{ route('devises.destroy', $devise->id) }}"
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
                                                <form action="{{ route('devises.restore', $devise->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button title="Restaurer"
                                                        onclick="return confirm('Voulez vous vraiment restaurer cette ligne')"
                                                        class="btn btn-sm btn-icon btn-secondary" href="#">
                                                        <i class="far fa-undo"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody><!-- /tbody -->
                </table><!-- /.table -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.page-section -->
@endsection
