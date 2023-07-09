@extends('layouts.body')
@section('title', 'Liste des balances | TMoney')
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
                    <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Balances</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        {{-- <a href="{{ route('balances.create') }}"><button type="button" class="btn btn-success btn-floated"><span
                    class="fa fa-plus"></span></button></a> --}}
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Liste des balances </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <!-- .page-section -->
    <div class="page-section">
        <!-- .card -->
        <div class="card card-fluid">
            <!-- .card-header -->
            {{-- <div class="card-header">
                <!-- .nav-tabs -->
                <a href="{{ route('balances.create') }}"><button type="button" class="btn btn-primary">Ajouter une
                        balance</button></a>
            </div><!-- /.card-header --> --}}
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
                                <option value="0"> Utilisateur </option>
                                <option value="1"> Minimum </option>
                                <option value="2"> Maximum </option>
                                <option value="3"> Montant </option>
                                <option value="4"> Montant total de la commission </option>
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
                            <th>Utilisateur</th>
                            <th> Minimum </th>
                            <th> Maximum </th>
                            <th> Montant </th>
                            <th> Montant total de la commission </th>
                            <th> Actions </th>

                        </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                        <!-- create empty row to passing html validator -->
                        @foreach ($balances as $balance)
                            <tr>
                                <td>{{ $balance->user->prenom }} {{ $balance->user->nom }}</td>
                                <td>{{ $balance->detailBalance->min }} {{ $balance->detailBalance->devise->deviseEntree }}
                                </td>
                                <td>{{ $balance->detailBalance->max }} {{ $balance->detailBalance->devise->deviseEntree }}
                                </td>
                                <td>{{ $balance->montant }} {{ $balance->detailBalance->devise->deviseEntree }}</td>
                                <td>{{ $balance->montantTotalComission }}
                                    {{ $balance->detailBalance->devise->deviseEntree }}</td>
                                <td>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superAdmin')
                                        <div class="d-flex justify-content-between">
                                            @if ($balance->deleted_at)
                                            @else
                                                <a class="btn btn-sm btn-icon btn-secondary"
                                                    href="{{ route('balances.edit', $balance->id) }}">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                            @endif

                                            @if (!$balance->deleted_at)
                                                <form id="" action="{{ route('balances.destroy', $balance->id) }}"
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
                                                <form action="{{ route('balances.restore', $balance->id) }}"
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
