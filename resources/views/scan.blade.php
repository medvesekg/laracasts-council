@extends('layouts.app')

@section('content')

    <div class="container">
        <ais-instant-search :search-client="searchClient" index-name="threads">
            <ais-search-box></ais-search-box>
            <ais-refinement-list attribute="channel.name"></ais-refinement-list>
            <ais-hits>
                <div slot="item" slot-scope="{ item }">
                    <a :href="item.path">
                        <h4>
                            <ais-highlight attribute="title" :hit="item"></ais-highlight>
                        </h4>
                        <p>
                            <ais-highlight attribute="body" :hit="item"></ais-highlight>
                        </p>
                    </a>
                </div>
            </ais-hits>
        </ais-instant-search>
    </div>

@endsection