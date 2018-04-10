@extends('admin.settings')



@section('before-vue-init')
    <script>
        window.blade = {
            settingsPage: {
                routes: {!! json_encode([]) !!}
            }
        }
    </script>
@endsection

@section('subtitle')
    ROUTES
@endsection

@section('searchbar')
    <!--<b-autocomplete class="searchbar settings-searchbar"
            v-model="searchQuery"
            placeholder="Cerca..."
            :keep-first="true"
            icon-pack="mdi"
            icon="magnify"
            :open-on-focus="false"
            :data="filtered"
            field="route">
    </b-autocomplete>-->
@endsection

@section('editor')
    <!--<button class="button is-text has-text-white is-uppercase is-undecored" @click="addRoutesForm()">
        <b-icon pack="mdi" icon="plus"></b-icon><span class="padding-sibling-thin">Aggiungi rotta</span>
    </button>-->
@endsection

@section('settings')
    <div class="section settings-section routes routes-wrapper">
        <div class="content routes-content">
            <img src="{{ Image::url('/uploads/public/bella-gnocca.jpg', 300, 300, ['blur'=>0.5]) }}" >
            @foreach(Storage::disk('s3')->allFiles('/uploads/public') as $file)
                <li>{{$file}}</li>
            @endforeach
        </div>
    </div>
@endsection