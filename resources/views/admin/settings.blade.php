@extends('layouts.admin')


@section('content')
    <div>
        <section class="hero is-primary is-medium">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title-big sans_serif-100">
                        Settings
                    </h1>
                    <h2 class="subtitle">
                        @yield('subtitle', 'Here you can change somethings like everything.')
                    </h2>
                </div>
            </div>
            <div class="hero-foot padding-sibling-normal">
                <div class="columns">
                    <div class="column is-2 align-self-center">
                        @yield('searchbar')
                    </div>
                    <div class="column is-8">
                        <nav class="tabs is-centered">
                            <div class="container">
                                <ul>
                                    <li class="{{ request()->getRelativeUriForPath('/admin/settings') == "" ? "is-active" : "" }}"><a href="/admin/settings">Global</a></li>
                                    @can('manage-routes')
                                        <li class="{{ request()->getRelativeUriForPath('/admin/settings/routes') == "" ? "is-active" : "" }}"><a href="/admin/settings/routes">Routes</a></li>
                                    @endcan
                                    @can('manage-media')
                                        <li class="{{ request()->getRelativeUriForPath('/admin/settings/media') == "" ? "is-active" : "" }}"><a href="/admin/settings/media">Media</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="column is-2 align-self-center has-text-centered">
                        @yield('editor')
                    </div>
                </div>
            </div>
        </section>
    </div>
    @yield('settings')
@endsection