@extends('layouts.master')
@section('title') @translate(Languages List) @endsection
@section('main-content')
    <div class="contentbar">
        <div class="row">
            <div class="m-0">
                <div class="m-0">
                    <a class="btn m-2 {{ Request::url() == route('language.translate', $lang->id) ? 'btn-success' : 'btn-primary' }} "
                        href="{{ route('language.translate', $lang->id) }}">
                        @translate(Solide text)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.static',$lang->id) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.static',$lang->id) }}">
                        @translate(Static text )
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'category_name']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'category_name']) }}">
                        @translate(Category Names)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'ad_title']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'ad_title']) }}">
                        @translate(Ad titles)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'ad_type_title']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'ad_type_title']) }}">
                        @translate(Ad types title)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'blog_categpry_title']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'blog_categpry_title']) }}">
                        @translate(blog Category title)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'blog_title']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'blog_title']) }}">
                        @translate(Blog title)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'city_name']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'city_name']) }}">
                        @translate(City name)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'item_conditions_title']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'item_conditions_title']) }}">
                        @translate(Item Conditions title)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'page_content_title']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'page_content_title']) }}">
                        @translate(Page Content title)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'page_group_name']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'page_group_name']) }}">
                        @translate(Page group name)
                    </a>
                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'page_title']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'page_title']) }}">
                        @translate(Page title)
                    </a>

                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'plane_title']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'plane_title']) }}">
                        @translate(Plane title)
                    </a>
                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'price_condition_title']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'price_condition_title']) }}">
                        @translate(Price condition title)
                    </a>
                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'state_name']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'state_name']) }}">
                        @translate(State name)
                    </a>
                    <a class="btn m-2 {{ Request::url() == route('language.type.translate', [$lang->id, 'menu_item_label']) ? 'btn-success' : 'btn-primary' }}"
                        href="{{ route('language.type.translate', [$lang->id, 'menu_item_label']) }}">
                        @translate(Menu Item label)
                    </a>

                </div>



            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="panel-title text-center">@translate(Language Translate)</h3>
                <p class="text-muted">@translate(You Can translate your own language in tow click,Follow this), <br>
                    @translate(google translate extension any browser then open the language translate)
                    @translate(page then click the google translate extension)
                    @translate(and translate the page and click the Copy Translations button and save.) </p>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('language.translate.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $lang->id }}">
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%"
                            id="tranlation-table">
\
                            @if (isset($result))
                            <tbody class="">
                                @foreach ($result as $key => $value)
                                    <tr class="">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="key w-25">{{ $key }}</td>
                                        <td>
                                            <input type="text" class="form-control value w-100"
                                                name="translations[{{ $key }}]"
                                                @isset(openJSONFile($lang->code)[$key])
                                                value="{{ $value }}"
                                            @endisset>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @else
                            <tbody class="">
                                @foreach (openJSONFile('en') as $key => $value)
                                    <tr class="">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="key w-25">{{ $key }}</td>
                                        <td>
                                            <input type="text" class="form-control value w-100"
                                                name="translations[{{ $key }}]"
                                                @isset(openJSONFile($lang->code)[$key])
                                                value="{{ openJSONFile($lang->code)[$key] }}"
                                            @endisset>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @endif

                        </table>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary" type="button" onclick="copy()">@translate(Copy Translations)
                            </button>
                            <button class="btn btn-primary" type="submit">@translate(Save)</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
