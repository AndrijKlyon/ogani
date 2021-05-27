@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Добавить категорию
        </a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"><i class="fa fa-folder"></i> Категории</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Категории</h3>
                </div>
                <div class="box-body">
                    @widget('TreeMenu', [
                        'tpl' => 'admin_treemenu',
                        'parent_element' => 'div',
                        'child_element' => 'div',
                        'cache' => false,
                        'categories' => $categories
                    ])
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
