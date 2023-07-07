@extends('layouts.body')
@section('title', 'Voir une transaction | TMoney')
@section('content')
    <header class="page-title-bar">
        <!-- .breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('transactions.index') }}"><i
                            class="breadcrumb-icon fa fa-angle-left mr-2"></i>Utilisateurs</a>
                </li>
            </ol>
        </nav><!-- /.breadcrumb -->
        <!-- floating action -->
        {{-- <button type="button" class="btn btn-success btn-floated"><span class="fa fa-plus"></span></button> --}}
        <!-- /floating action -->
        <!-- title and toolbar -->
        {{-- <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto"> Ajouter une transaction </h1><!-- .btn-toolbar -->
            <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
        </div><!-- /title and toolbar --> --}}
    </header><!-- /.page-title-bar -->
    <div class="page-section">

    </div>
@endsection
