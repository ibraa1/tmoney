@extends('layouts.body')
@section('title', 'Liste des utilisateurs | TMoney')
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
                    <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Utilisateurs</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        <a href="{{ route('users.create') }}"><button type="button" class="btn btn-success btn-floated"><span
                    class="fa fa-plus"></span></button></a>
        <!-- /floating action -->
        <!-- title and toolbar -->
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Liste des utilisateurs </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar -->
    </header><!-- /.page-title-bar -->
    <!-- .page-section -->
    <div class="page-section">
        <!-- .card -->
        <div class="card card-fluid">
            <!-- .card-header -->
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superAdmin')
                <div class="card-header">
                    <!-- .nav-tabs -->
                    <a href="{{ route('users.create') }}"><button type="button" class="btn btn-primary">Ajouter un
                            utilisateur</button></a>
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
                                <option value="0"> Adresse </option>
                                <option value="1"> Nom </option>
                                <option value="2"> Telephone </option>
                                <option value="3"> Role </option>
                                <option value="4"> Balance </option>
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
                            <th></th>
                            <th> Nom Complet </th>
                            <th> Telephone </th>
                            <th> Role </th>
                            <th> Balance </th>
                            <th> Actions </th>

                        </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                        <!-- create empty row to passing html validator -->
                        @foreach ($users as $user)
                            <tr>
                                <td> <a href="#" class="tile tile-img mr-1"> <img class="img-fluid"
                                            src="{{ asset($user->image) }}" alt="Card image cap"></a>{{ $user->adresse }}
                                </td>
                                <td>{{ $user->prenom }} {{ $user->nom }}</td>
                                <td>{{ $user->numero_tel }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    @foreach ($user->balances as $balance)
                                        {{ $balance->montant }} {{ $balance->detailBalance->devise->deviseEntree }}<br>
                                    @endforeach

                                </td>
                                <td>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superAdmin')
                                        <div class="d-flex justify-content-between">
                                            @if ($user->deleted_at)
                                            @else
                                                <a class="btn btn-sm btn-icon btn-secondary"
                                                    href="{{ route('users.edit', $user->id) }}">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-sm btn-icon btn-secondary"
                                                    href="{{ route('balance', $user->id) }}">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            @endif

                                            @if (!$user->deleted_at)
                                                @if (Auth::user()->role == 'superAdmin')
                                                    <form id="" action="{{ route('users.destroy', $user->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button title="Supprimer"
                                                            onclick="return confirm('Voulez vous vraiment supprimer cette ligne')"
                                                            class="btn btn-sm btn-icon btn-secondary" href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                <form action="{{ route('users.restore', $user->id) }}" method="post">
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
