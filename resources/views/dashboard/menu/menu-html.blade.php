<?php
$currentUrl = url()->current();
?>
<div id="hwpwrap">
    <div class="custom-wp-admin wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar">
        <div id="wpwrap">
            <div id="wpcontent">
                <div id="wpbody">
                    <div id="wpbody-content">

                        <div class="wrap">


                            <div id="nav-menus-frame">

                                @if (request()->has('menu') && !empty(request()->input('menu')))
                                    <div id="menu-settings-column" class="metabox-holder">

                                        <div class="clear"></div>
                                        <div class="card border border-primary mb-3">
                                            <div class="card-header">
                                                <h5 class="card-title">Custom Link</h5>
                                            </div>
                                            <div class="card-body">

                                                <form class="form-horizontal" enctype="multipart/form-data"
                                                    action="{{ route('menu.item.store') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="">
                                                            <label class="control-label">@translate(Name) <span
                                                                    class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="">
                                                            <input type="text" class="form-control" name="name"
                                                                required placeholder="@translate(Ex: menu name)">
                                                        </div>
                                                        <input type="hidden" name="menu"
                                                            value="{{ request()->get('menu') }}">
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        @error('link')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="">
                                                            <label class="control-label">@translate(Link) <span
                                                                    class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="">
                                                            <input type="url" class="form-control" name="link"
                                                                required placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="float-left">
                                                        <button class="btn btn-primary mt-2" type="submit">Add menu
                                                            item</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="card  border border-primary mb-3">
                                            <div class="card-header">
                                                <h5 class="card-title">Select another options</h5>
                                            </div>
                                            <div class="card-body">
                                                <form enctype="multipart/form-data"
                                                    action="{{ route('menu.item.store') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">

                                                        <label class="control-label">@translate(Name) <span
                                                                class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" name="name" required
                                                            placeholder="@translate(Ex: menu name)" />

                                                    </div>
                                                    <input type="hidden" name="menu"
                                                        value="{{ request()->get('menu') }}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    @error('link')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <div class="form-group">
                                                        <button class="btn btn-primary mt-2" type="submit">Add menu
                                                            item</button>
                                                    </div>

                                                    {{-- <div class="scrol-card2"> --}}
                                                    @foreach (App\Http\Controllers\Dashboard\MenuController::categories() as $category1)
                                                        <div class="form-check-inline">
                                                            <input name="link" class="form-check-input" type="radio"
                                                                value="{{ add_query_params(['cat' => $category1->id]) }}"
                                                                id="{{ $category1->slug }}" />
                                                            <label class="form-check-label"
                                                                for="{{ $category1->slug }}">
                                                                {{ $category1->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    {{-- <div> --}}
                                                </form>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="card  border border-primary mb-3">
                                            <div class="card-header">
                                                <h5 class="card-title">Select Brands</h5>
                                            </div>
                                            <div class="card-body">
                                                <form class="" enctype="multipart/form-data"
                                                    action="{{ route('menu.item.store') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="control-label">@translate(Name) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name" required
                                                            placeholder="@translate(Ex: menu name)" />
                                                    </div>
                                                    <input type="hidden" name="menu"
                                                        value="{{ request()->get('menu') }}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    @error('link')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <div class="form-group">
                                                        <button class="btn btn-primary mt-2" type="submit">Add menu
                                                            item</button>
                                                    </div>

                                                    {{-- <div class="scrol-card"> --}}
                                                    @foreach (App\Http\Controllers\Dashboard\MenuController::brands() as $brand)
                                                        <div class="form-check-inline">
                                                            <input name="link" class="form-check-input" type="radio"
                                                                value="{{ add_query_params(['brand' => $brand->id]) }}"
                                                                id="{{ $brand->slug }}" />
                                                            <label class="form-check-label" for="{{ $brand->slug }}">
                                                                {{ $brand->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    {{-- <div> --}}
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                <div id="menu-management-liquid">
                                    <div id="menu-management">
                                        <form id="update-nav-menu" action="" method="post"
                                            enctype="multipart/form-data">
                                            <div class="menu-edit ">
                                                <div id="nav-menu-header">
                                                    <div class="major-publishing-actions">
                                                        <label class="menu-name-label howto open-label" for="menu-name">
                                                            <span>Name</span>
                                                            <input name="menu-name" id="menu-name" type="text"
                                                                class="menu-name regular-text menu-item-textbox" readonly
                                                                title="Enter menu name"
                                                                value="@if (isset($indmenu)){{ $indmenu->name }}@endif">
                                                            <input type="hidden" id="idmenu"
                                                                value="@if (isset($indmenu)){{ $indmenu->id }}@endif" />
                                                        </label>


                                                    </div>
                                                </div>
                                                <div id="post-body" class="">
                                                    <div id="post-body-content">

                                                        @if (request()->has('menu'))
                                                            <h3>Menu Structure</h3>
                                                            <div class="drag-instructions post-body-plain" style="">
                                                                <p>
                                                                    Place each item in the order you prefer. Click on
                                                                    the arrow to the maximum right of the item to display more
                                                                    configuration options.
                                                                </p>
                                                            </div>

                                                        @else
                                                            <h3>Select the menu</h3>
                                                        @endif

                                                        <ul class="menu ui-sortable" id="menu-to-edit">
                                                            @if (isset($menus))
                                                                @foreach ($menus as $m)
                                                                    <li id="menu-item-{{ $m->id }}"
                                                                        class="menu-item menu-item-depth-{{ $m->depth }} menu-item-page menu-item-edit-inactive pending"
                                                                        style="display: list-item;">
                                                                        <dl class="menu-item-bar">
                                                                            <dt class="menu-item-handle">
                                                                                <span class="item-title"> <span
                                                                                        class="menu-item-title"> <span
                                                                                            id="menutitletemp_{{ $m->id }}">{{ $m->label }}</span>
                                                                                        <span
                                                                                            style="color: transparent;">|{{ $m->id }}|</span>
                                                                                    </span> <span class="is-submenu"
                                                                                        style="@if ($m->depth == 0)display: none;@endif">Subelement</span>
                                                                                </span>
                                                                                <span class="item-controls"> <span
                                                                                        class="item-type">Link</span>
                                                                                    <span class="item-order hide-if-js">
                                                                                        <a href="{{ $currentUrl }}?action=move-up-menu-item&menu-item={{ $m->id }}&_wpnonce=8b3eb7ac44"
                                                                                            class="item-move-up"><abbr
                                                                                                title="Move Up">↑</abbr></a>
                                                                                        | <a href="{{ $currentUrl }}?action=move-down-menu-item&menu-item={{ $m->id }}&_wpnonce=8b3eb7ac44"
                                                                                            class="item-move-down"><abbr
                                                                                                title="Move Down">↓</abbr></a>
                                                                                    </span>
                                                                                    <a class="item-edit"
                                                                                        id="edit-{{ $m->id }}"
                                                                                        title=" "
                                                                                        onclick="forModal('{{ route('menu.item.edit', $m->id) }}', '@translate(Menu Item update)')"
                                                                                        href="javascript:void(0)">
                                                                                    </a>

                                                                                </span>
                                                                            </dt>
                                                                        </dl>
                                                                        <ul class="menu-item-transport"></ul>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                        <div class="menu-settings">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="nav-menu-footer">
                                                    <div class="major-publishing-actions">


                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="clear"></div>
                    </div>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
    </div>
</div>
