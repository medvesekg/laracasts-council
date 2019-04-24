<reply inline-template :attributes="{{$reply}}" v-cloak>
    <div id="reply-{{ $reply->id }}" class="card my-2">
        <div class="card-header">
            <div class="level">
                <div class="flex">
                    <a href="{{ route('profile', $reply->owner->name) }}">
                        {{$reply->owner->name}}
                    </a>
                    said {{$reply->created_at->diffForHumans()}}...
                </div>
                @auth
                    <div>
                        <favorite :reply="{{ $reply }}"></favorite>
                    </div>
                @endauth
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-sm btn-primary" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing=false">Cancel</button>
            </div>
            <div v-else v-text="body"></div>
        </div>

        @can('update', $reply)
        <div class="card-footer level">
            <button class="btn btn-sm mr-1" @click="editing=true">Edit</button>
            <button class="btn btn-danger btn-sm" type="submit" @click="destroy">Delete</button>

        </div>
        @endcan
    </div>
</reply>