@extends('layouts.admin')

 @section('content')
 <section class="content-header">
    <h1>
      Редактирование предложения недели
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
      <li><a href="{{ route('week_deals.index') }}"><i class="fa fa-gift"></i> Предложение недели</a></li>
      <li class="active"> Редактирование предложения недели</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!-- | Your Page Content Here |  -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <form action="{{ route('week_deals.update', ['week_deal' => $weekdeal->id]) }}" method="post" enctype="multipart/form-data" data-toggle="validator">
                            @csrf
                            @method('PUT')
                            <div class="box-header with-border">
                                <h3 class="box-title">Предложение недели</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="template_title">Товар, для которого создается акционное предложение</label>
                                    <select name="product_id" class="form-control select2" required style="width: 100%;">
                                        <option selected="selected"
                                                value="{{ $weekdeal->product->id }}">{{ $weekdeal->product->title }}</option>
                                      </select>
                                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                      <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="ended_at">Дата окончания акции (включительно)</label>
                                    <input id="datepicker"
                                            type="text"
                                            name="ended_at"
                                            class="form-control"
                                            placeholder="Дата окончания акции"
                                            value="{{ old('ended_at') ? old('ended_at') : Carbon\Carbon::create($weekdeal->ended_at)->format('d/m/Y') }}">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>

                            </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-upload"></i>
                                        Сохранить предложение
                                    </button>
                                    <a class="btn btn-warning" href="{{ route('week_deals.index') }}"><i class="fa fa-ban"></i> Отмена</a>
                                </div>
                        </form>

                </div>
            </div>
        </div>


  </section>

  @endsection

