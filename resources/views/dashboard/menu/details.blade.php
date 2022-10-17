@extends('layouts.master')
@section('title')
    @translate(Menu)
@endsection
@section('sub-title')
    @translate(Items)
@endsection
<style type="text/css">
    /* html,
    body,
    ul,
    li {
      margin: 0;
      padding: 0;
    } */
    /* body {
      font-family: verdana;
      background: #3d4f61;
      color: #fff;
    } */
    ul,
    li {
        list-style-type: none;
        padding: 3px;
        color: #fff;
        border: 1px solid #000;
    }

    ul {
        padding: 10px;
    }

    ul li {
        padding-left: 50px;
        margin: 10px 0;
        border: 1px solid #000;
    }

    li div {
        padding: 7px;
        background-color: #d870a9;
        border: 1px solid #000;
    }

    li,
    ul,
    div {
        border-radius: 3px;
    }

    .scrollUp {
        position: fixed;
        top: 0;
        left: 0;
        height: 48px;
        width: 50px;
        border: 1px solid red;
    }

    .scrollDown {
        position: fixed;
        bottom: 0;
        left: 0;
        height: 48px;
        width: 50px;
        border: 1px solid red;
    }

    /* .sortableListsClose ul,
    .sortableListsClose ol {
      display: none;
    } */
    .red {
        background-color: #ff9999;
    }

    .blue {
        background-color: #d870a9;
    }

    .green {
        background-color: #99ff99;
    }

    .pV10 {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .dN {
        display: none;
    }

    .zI1000 {
        z-index: 1000;
    }

    .bgC1 {
        background-color: #ccc;
    }

    .bgC2 {
        background-color: #ff8;
    }

    .bgC3 {
        background-color: #f0f;
    }

    .bgC4 {
        background-color: #ed87bd;
    }

    .small1 {
        font-size: 0.8em;
    }

    .small2 {
        font-size: 0.7em;
    }

    .small3 {
        font-size: 0.6em;
    }

    #sTreeBase {
        width: 100px;
        height: 50px;
        background-color: blue;
    }

    #text {
        padding: 10px 0;
    }

    #sTree {
        background-color: green;
    }

    #sTree2 {
        margin: 10px 0;
    }

    /* #center {
      width: 950px;
      margin: 0 auto;
      padding: 10px;
    } */
</style>
@endsection
@section('main-content')
<div class="contentbar">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@translate(Menu Item Create)</h3>
                </div>
                <div class="card-body">

                    <div class="card border border-primary">
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
                                        <input type="text" class="form-control" name="name" required
                                            placeholder="@translate(Ex: menu name)">
                                    </div>
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}" required>
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
                                        <input type="url" class="form-control" name="link" required
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="float-left">
                                    <button class="btn btn-primary mt-2" type="submit">Add menu item</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <hr>
                    <div class="card border border-primary">
                        <div class="card-header">
                            <h5 class="card-title">Select Category</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" enctype="multipart/form-data"
                                action="{{ route('menu.item.store') }}" method="POST">
                                @csrf
                                <div class="form-group">

                                    <label class="control-label">@translate(Name) <span
                                            class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="name" required
                                        placeholder="@translate(Ex: menu name)">

                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}" required>
                                </div>
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
                                    <button class="btn btn-primary" type="submit">Add menu item</button>
                                </div>

                                <div class="scrol-card ">
                                    @foreach ($categories as $category1)
                                        <div class="form-check">
                                            <input name="link" class="form-check-input" type="radio"
                                                value="{{ add_query_params(['cat' => $category1->id]) }}"
                                                id="{{ $category1->slug }}">
                                            <label class="form-check-label" for="{{ $category1->slug }}">
                                                {{ $category1->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <div>
                            </form>
                        </div>
                    </div>

                    <hr>
                    <div class="card border border-primary">
                        <div class="card-header">
                            <h5 class="card-title">Select Brands</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" enctype="multipart/form-data"
                                action="{{ route('menu.item.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label">@translate(Name) <span
                                            class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="name" required
                                        placeholder="@translate(Ex: menu name)">
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}" required>
                                </div>
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
                                    <button class="btn btn-primary  mt-2" type="submit">Add menu item</button>
                                </div>

                                <div class="scrol-card ">
                                    @foreach ($brands as $brand)
                                        <div class="form-check">
                                            <input name="link" class="form-check-input" type="radio"
                                                value="{{ add_query_params(['brand' => $brand->id]) }}"
                                                id="{{ $brand->slug }}">
                                            <label class="form-check-label" for="{{ $brand->slug }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!--there are the main content-->
        </div>
    </div>
</div>
</div>
</div>
<div class="col-md-8 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">{{ $menu->name }}</h2>
        </div>
        <div class="card-body">
            <div id="center">
                <ul class="sTree bgC4" id="sTree2">
                    <li class="bgC4" id="item_a">
                        <div>Item a</div>
                    </li>
                    <li class="bgC4" id="item_b">
                        <div>Item b</div>
                    </li>
                    <li class="bgC4 sortableListsClose" id="item_c">
                        <div><span class="sortableListsOpener"> </span>Item c</div>
                        <ul class="">
                            <li class="bgC4" id="item_1">
                                <div>Item 1</div>
                            </li>
                            <li class="bgC4" id="item_2">
                                <div>Item 2</div>
                            </li>
                            <li class="bgC4" id="item_3">
                                <div>Item 3</div>
                            </li>
                            <li class="bgC4" id="item_4">
                                <div>Item 4</div>
                            </li>
                            <li class="bgC4" id="item_5">
                                <div>Item 5</div>
                            </li>
                        </ul>
                    </li>
                    <li class="bgC4 sortableListsClose" id="item_d">
                        <div><span class="sortableListsOpener"> </span>Item c</div>
                        <ul class="">
                            <li class="bgC4" id="item_1">
                                <div>Item 1</div>
                            </li>
                            <li class="bgC4" id="item_2">
                                <div>Item 2</div>
                            </li>
                            <li class="bgC4" id="item_3">
                                <div>Item 3</div>
                            </li>
                            <li class="bgC4" id="item_4">
                                <div>Item 4</div>
                            </li>
                            <li class="bgC4" id="item_5">
                                <div>Item 5</div>
                            </li>
                        </ul>
                    </li>
                    <li class="bgC4 sortableListsClose" id="item_e">
                        <div><span class="sortableListsOpener"> </span>Item c</div>
                        <ul class="">
                            <li class="bgC4" id="item_1">
                                <div>Item 1</div>
                            </li>
                            <li class="bgC4" id="item_2">
                                <div>Item 2</div>
                            </li>
                            <li class="bgC4" id="item_3">
                                <div>Item 3</div>
                            </li>
                            <li class="bgC4" id="item_4">
                                <div>Item 4</div>
                            </li>
                            <li class="bgC4" id="item_5">
                                <div>Item 5</div>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="scrollUp dN"></div>
                <div class="scrollDown dN"></div>
            </div>
            <!--begin: Datatable -->
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>@translate(S / L)</th>
                        <th>@translate(Name)</th>
                        <th>@translate(Assets)</th>
                        <th>@translate(Status)</th>
                        <th>@translate(Action)</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($menu->items as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <a href="{{ $item->link }}" target="_blank">
                                    {{ checkNull($item->name) }}
                                </a>
                            </td>
                            <td>
                                @if ($item->icon_class != null)
                                    @translate(Icon css class) : {{ $item->icon_class }}
                                @endif

                                @if ($item->icon != null)
                                    @translate(Icon) <br>
                                    <img src="{{ filePath($item->icon) }}" class="img-fluid" width="60px"
                                        height="60px">
                                @endif

                                @if ($item->image != null)
                                    @translate(Image) <br>
                                    <img src="{{ filePath($item->image) }}" class="img-fluid" width="80px"
                                        height="80px">
                                @endif

                            </td>
                            <td>
                                <div class="form-group">
                                    <input data-id="{{ $item->id }}"
                                        {{ $item->is_published == true ? 'checked' : null }}
                                        data-url="{{ route('menu.item.published') }}" type="checkbox"
                                        class="js-switch-danger-small">
                                </div>
                            </td>
                            <td>
                                <div class="dropdown-basic">
                                    <div class="dropdown">
                                        <div class="btn-group mb-0">
                                            <button class="dropbtn btn-primary btn-round"
                                                type="button">@translate(Action)
                                                <span><i class="fa fa-arrow-down"></i></span></button>
                                            <div class="dropdown-content">
                                                <a class="dropdown-item"
                                                    href="{{ route('menu.item.edit', $item->id) }}">
                                                    <i class="feather icon-edit mr-2"></i>@translate(Edit)</a>

                                                <a class="dropdown-item"
                                                    href="{{ route('menu.item.destroy', $item->id) }}">
                                                    <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                            </div>
                                        </div>
                                    </div>



                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>

</div>
</div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/jquery-sortable-lists.js?v2') }}"></script>
<script type="text/javascript">
    $(function() {
        "use strict"
        var options = {
            placeholderCss: {
                "background-color": "#ff8"
            },
            hintCss: {
                "background-color": "#bbf"
            },
            onChange: function(cEl) {
                console.log("onChange");
            },
            complete: function(cEl) {
                console.log("complete");
            },
            isAllowed: function(cEl, hint, target) {
                // Be carefull if you test some ul/ol elements here.
                // Sometimes ul/ols are dynamically generated and so they have not some attributes as natural ul/ols.
                // Be careful also if the hint is not visible. It has only display none so it is at the previouse place where it was before(excluding first moves before showing).
                if (target.data("module") === "c" && cEl.data("module") !== "c") {
                    hint.css("background-color", "#ff9999");
                    return false;
                } else {
                    hint.css("background-color", "#99ff99");
                    return true;
                }
            },
            opener: {
                active: true,
                as: "html", // if as is not set plugin uses background image
                close: '<i class="fa fa-minus c3"></i>', // or 'fa-minus c3',  // or './imgs/Remove2.png',
                open: '<i class="fa fa-plus"></i>', // or 'fa-plus',  // or'./imgs/Add2.png',
                openerCss: {
                    display: "inline-block",
                    //'width': '18px', 'height': '18px',
                    float: "left",
                    "margin-left": "-35px",
                    "margin-right": "5px",
                    //'background-position': 'center center', 'background-repeat': 'no-repeat',
                    "font-size": "1.1em",
                },
            },
            ignoreClass: "clickable",
        };
        $("#sTree2").sortableLists(options);

        console.log($("#sTree2").sortableListsToArray());
        console.log($("#sTree2").sortableListsToHierarchy());
        console.log($("#sTree2").sortableListsToString());
    });
</script>
@endsection
