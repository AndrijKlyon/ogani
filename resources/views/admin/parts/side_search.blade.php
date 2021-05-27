<form action="{{ route('admin.search') }}" method="get" class="sidebar-form">
    @csrf
    <div class="input-group">

      <input type="text" id="adminsearch_input" name="search" class="form-control" placeholder="Поиск товаров...">
      <span class="input-group-btn">
          <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>

    </div>
  </form>
