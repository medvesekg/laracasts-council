@extends('layouts.app')

@section('content')
    <div class="container">
            <ais-instant-search :search-client="searchClient" index-name="threads">
                <ais-configure query="{{ request('q') }}"></ais-configure>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <ais-hits>
                            <template slot="item" slot-scope="{ item }">
                                    <a :href="item.path">
                                        <ais-highlight attribute="title" :hit="item"></ais-highlight>
                                    </a>
                            </template>
                        </ais-hits>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Search
                            </div>
                            <div class="card-body">
                                <ais-search-box autofocus :classes="{'ais-SearchBox-input': 'form-control'}">
                                </ais-search-box>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">Fitler by channel</div>
                            <div class="card-body">
                                <ais-refinement-list attribute="channel.name"></ais-refinement-list>
                            </div>
                        </div>
                    @if(count($trending))
                            <div class="card">
                                <div class="card-header">
                                    Trending Threads
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($trending as $thread)
                                            <li class="list-group-item">
                                                <a href="{{url($thread->path)}}">
                                                    {{ $thread->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </ais-instant-search>
    </div>
@endsection
