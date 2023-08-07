@extends('layouts.body')
@section('title', 'Liste des transactions | TMoney')
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
                    <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Transactions</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        <a href="{{ route('transactions.create') }}"><button type="button" class="btn btn-success btn-floated"><span
                    class="fa fa-plus"></span></button></a>
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Liste des transactions </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <!-- .page-section -->
    <div class="page-section">
        <!-- .card -->
        <div class="card card-fluid">
            <!-- .card-header -->
            <div class="card-header">
                <!-- .nav-tabs -->
                @if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superAdmin')
                    <a href="{{ route('transactions.create') }}"><button type="button" class="btn btn-primary">Faire un
                            transfert</button></a>

                    <a href="{{ route('retrait') }}"><button type="button" class="btn btn-secondary">Faire un
                            retrait</button></a>
                @endif
            </div><!-- /.card-header -->
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
                                <option value="1"> Operation </option>
                                <option value="2"> Montant </option>
                                <option value="3"> Statut </option>
                                <option value="4"> Client </option>
                                <option value="5"> Comission </option>
                                <option value="6"> Date </option>
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
                            <th> Agent </th>
                            <th> Operation </th>
                            <th> Montant </th>
                            <th> Statut </th>
                            <th> Client </th>
                            <th> Comission de l'agent </th>
                            <th> Date </th>
                            <th> Actions </th>

                        </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                        <!-- create empty row to passing html validator -->
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>
                                    <a href="#" class="tile tile-img mr-1"> <img class="img-fluid"
                                            src="{{ asset($transaction->agent->image) }}" alt="Card image cap">
                                    </a>{{ $transaction->agent->prenom }} {{ $transaction->agent->nom }}
                                </td>
                                <td>{{ $transaction->type }}</td>
                                @if ($transaction->type == 'retrait')
                                    <td>{{ $transaction->montant }} {{ $transaction->devise->deviseSortie }}</td>
                                @else
                                    <td>{{ $transaction->montant }} {{ $transaction->devise->deviseEntree }}</td>
                                @endif
                                <td>{{ $transaction->statut }}</td>
                                <td>
                                    <a href="#" class="tile tile-img mr-1"> <img class="img-fluid"
                                            src="{{ asset($transaction->client->image) }}" alt="Card image cap">
                                    </a>
                                    {{ $transaction->client->prenom }} {{ $transaction->client->nom }}
                                </td>
                                @if ($transaction->type != 'retrait')
                                    <td>{{ $transaction->agentCommission }} {{ $transaction->devise->deviseEntree }}</td>
                                @else
                                    <td>{{ $transaction->retraitantCommission }} {{ $transaction->devise->deviseSortie }}
                                    </td>
                                @endif
                                <td>{{ $transaction->date }}</td>
                                <td>
                                    @if ($transaction->statut !== 'annulé')
                                        @if ($transaction->type != 'retrait')
                                            <a class="btn btn-sm btn-icon btn-secondary"
                                                href="{{ route('transactions.factureTransfert', $transaction->id) }}">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-sm btn-icon btn-secondary"
                                                href="{{ route('transactions.factureRetrait', $transaction->id) }}">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        @endif
                                    @endif


                                    <div class="d-flex justify-content-between">

                                        @if ($transaction->deleted_at)
                                        @else
                                            @if ($transaction->statut == 'en attente')
                                                <form id=""
                                                    action="{{ route('transactions.cancel', $transaction->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button class="btn btn-sm btn-icon btn-secondary"
                                                        onclick="return confirm('Voulez vous vraiment annulé cette transaction ?')"
                                                        title="Annulé">
                                                        <i class="fa fa-ban"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif

                                        @if (Auth::user()->role == 'admin')
                                            @if (!$transaction->deleted_at)
                                                <form id=""
                                                    action="{{ route('transactions.destroy', $transaction->id) }}"
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
                                                <form action="{{ route('transactions.restore', $transaction->id) }}"
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
