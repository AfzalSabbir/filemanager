@extends('backpack::layouts.top_left')


@section('after_scripts')
    @include('vendor.elfinder.common_scripts')
    @include('vendor.elfinder.common_styles')

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $().ready(function () {
            $('#elfinder').elfinder({
                // set your elFinder options here
                @if($locale)
                lang      : '{{ $locale }}', // locale
                @endif
                customData: {
                    _token: '{{ csrf_token() }}',
                },
                url       : '{{ route("elfinder.connector") }}',  // connector URL
                soundPath : '{{ asset($dir.'/sounds') }}',
            });
        });
    </script>
@endsection

@php
    $breadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      trans('backpack::crud.file_manager') => false,
    ];
@endphp

@section('header')
    <section class="container-fluid">
        <div class="d-flex justify-content-between">
            <h2>{{ trans('backpack::crud.file_manager') }}</h2>
            <label class="my-auto d-flex" style="gap: 6px">
                <span class="text-nowrap">{{__('Change theme')}} : </span>
                <select id="themeChanger" class="form-control form-control-sm">
                    @foreach(config('elfinder.themes') ?? [] as $key => $themes)
                        <optgroup label="{{ucfirst($key)}}">
                            @foreach($themes as $themeName => $theme)
                                <option value="{{"$key.$themeName"}}"
                                        {{ "$key.$themeName" === config('elfinder.default') ? 'selected' : ''}}>
                                    {{ucfirst($themeName)}}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </label>
        </div>
        <script>
            let themeSelector = document.querySelector('select#themeChanger');
            themeSelector.addEventListener('change', function () {
                let theme = this.value;

                console.log(`/admin/elfinder/${theme}`);

                //fetch post
                fetch(`/admin/elfinder/${theme}`, {
                    method : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    body   : JSON.stringify({
                        theme: theme,
                    }),
                }).then(function (response) {
                    window.location.reload();
                });
            });
        </script>
    </section>
@endsection

@section('content')

    <!-- Element where elFinder will be created (REQUIRED) -->
    <div id="elfinder"></div>

@endsection
