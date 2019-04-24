{{-- EDITING --}}
<div class="card" v-if="editing">
    <div class="card-header">
        <div class="level">
            <input type="text" value="{{ $thread->title }}" class="form-control" v-model="form.title">
        </div>
    </div>

    <div class="card-body">
        <div class="form-group">
            <wysiwyg v-model="form.body"></wysiwyg>
        </div>
    </div>

    <div class="card-footer">
        <div class="level">
            <button class="btn btn-sm level-item" @click="resetForm">Cancel</button>
            <button class="btn btn-sm btn-primary level-item" @click="update">Update</button>
            @can('update', $thread)
                <form action="{{$thread->path()}}" method="POST" class="ml-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link">Delete Thread</button>
                </form>
            @endcan
        </div>
    </div>
</div>
{{-- VIEWING --}}
<div class="card" v-else>
    <div class="card-header">
        <div class="level">
            <img src="{{ $thread->creator->avatar_path }}" width="25" height="25" class="mr-1">
            <h5 class="flex">
                <a href="{{ route('profile', $thread->creator->name)  }}">{{ $thread->creator->name }}</a> posted:
                <span v-text="title"></span>
            </h5>
        </div>
    </div>

    <div class="card-body" v-html="body"></div>

    <div class="card-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-sm" @click="editing=true">Edit</button>
    </div>
</div>