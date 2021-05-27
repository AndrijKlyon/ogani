@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('products.index') }}"><i class="fa fa-cube"></i> Товары</a></li>
        <li class="active"> Информация о товаре</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Товар "{{ $product['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td style="min-width: 250px;">ID товара</td>
                                    <td>{{ $product['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название</td>
                                    <td>{{ $product['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Псевдоним</td>
                                    <td>{{ $product['alias'] }}</td>
                                </tr>
                                <tr>
                                    <td>Категория</td>
                                    <td><a href="{{ route('categories.show', ['category' => $product->category['id']]) }}">{{ $product->category['title'] }}</a></td>
                                </tr>
                                <tr>
                                    <td>Бренд</td>
                                    <td><a href="{{ route('brands.show', ['brand' => $product->brand['id']]) }}">{{ $product->brand['title'] }}</a></td>
                                </tr>
                                <tr>
                                    <td>Ключевые слова</td>
                                    <td> {{ $product['keywords'] }}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td> {{ $product['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Цена товара</td>
                                    <td> {{ $product['price'] }} {{ config('template_settings.currency') }}</td>
                                </tr>
                                <tr>
                                    <td>Акционная цена товара</td>
                                    <td>
                                        @if($product['special_price'])
                                            {{ $product['special_price'] }} {{ config('template_settings.currency') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Контент</td>
                                    <td>
                                        {!! $product->content  !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Похожие товары</td>
                                    <td>
                                        @if($product->related && !empty($product->related))
                                            @foreach($product->related as $item)
                                                {{ $item['title'] }}<br>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Изображения</td>
                                    <td>
                                        @if($gallery_images && $gallery_images->isNotEmpty())
                                            @foreach($gallery_images as $item)
                                                <img style="width: 120px;" src="{{ asset('img/products/'.$item->img) }}" />
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Характеристики</td>
                                    <td>
                                        @if($specifications && $specifications->isNotEmpty())
                                            @foreach($specifications as $item)
                                                {{ $item->feature }}: {{ $item->value }}<br>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Модификации товара</td>
                                    <td>
                                        @if($modifications && $modifications->isNotEmpty())
                                            @foreach($modifications as $item)
                                                {{ $item->option['title'] }} :
                                                @if($item->modification_price == null)
                                                    @if($product->special_price != null)
                                                        {{ $product->special_price }}
                                                        <small style="text-decoration:line-through;">
                                                            {{ $product->price }}
                                                        </small>
                                                    @else
                                                        {{ $product->price  }}
                                                    @endif
                                                    {{ config('template_settings.currency') }} (базовая)
                                                @else
                                                {{ $item->modification_price }} {{ config('template_settings.currency') }}
                                                @endif
                                                <br>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Опубликовано</td>
                                    <td>{{ $product['status'] == '0' ? 'Нет' : 'Да'  }} </td>
                                </tr>
                                <tr>
                                    <td>Отображение на Главной</td>
                                    <td>{{ $product['hit'] == '0' ? 'Нет' : 'Да'  }} </td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td> {{ $product['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата обновления</td>
                                    <td> {{ $product['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('products.index') }}"><i class="fa fa-reply"></i> Вернуться к списку товаров</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
