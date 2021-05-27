<ul class="sidebar-menu" data-widget="tree">
    <li class="header">РАЗДЕЛЫ</li>
    <li><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> <span>Главная</span></a></li>
    <li class="treeview">
      <a href="#"><i class="fa fa-shopping-cart"></i> <span>Заказы</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('orders.index') }}">Список заказов</a></li>
        <li><a href="{{ route('order_statuses.index') }}">Статусы заказов</a></li>
      </ul>
    </li>
    <li><a href="{{ route('categories.index') }}"><i class="fa fa-folder"></i> <span>Категории товаров</span></a></li>
    <li><a href="{{ route('products.index') }}"><i class="fa fa-folder"></i> <span>Товары</span></a></li>
    <li class="treeview">
      <a href="#"><i class="fa fa-barcode"></i> <span>Характеристики товаров</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('brands.index') }}">Бренды</a></li>
        <li><a href="{{ route('options.index') }}">Опции </a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#"><i class="fa fa-truck"></i> <span>Оплата и доставка</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('pay_methods.index') }}">Способы оплаты</a></li>
        <li><a href="{{ route('shipping_methods.index') }}">Способы доставки</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#"><i class="fa fa-sticky-note"></i> <span>Блог</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('posts.index') }}">Посты</a></li>
        <li><a href="{{ route('post_categories.index') }}">Категории постов</a></li>
        <li><a href="{{ route('post_tags.index') }}">Теги постов</a></li>
      </ul>
    </li>

    <li><a href="{{ route('shopinfos.index') }}"><i class="fa fa-laptop"></i> <span>Справочные статьи</span></a></li>
    <li><a href="{{ route('aboutrecords.index') }}"><i class="fa fa-info"></i> <span>О магазине</span></a></li>
    <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>
    <li><a href="{{ url('/admin/mail/messages?filter[folder]=inbox') }}"><i class="fa fa-envelope"></i> <span>Почтовые сообщения</span></a></li>
    <li><a href="{{ route('subscribers.index') }}"><i class="fa fa-pencil-square"></i> <span>Подписчики</span></a></li>
    <li><a href="{{ route('admincomments.index') }}"><i class="fa fa-comment"></i> <span>Комментарии</span></a></li>
    <li><a href="{{ route('ratings.index') }}"><i class="fa fa-star"></i> <span>Рейтинги</span></a></li>
    <li><a href="{{ route('week_deals.index') }}"><i class="fa fa-gift"></i> <span>Предложение недели</span></a></li>
    <li><a href="{{ route('admin.cache') }}"><i class="fa fa-database"></i> <span>Кэширование</span></a></li>

  </ul>
