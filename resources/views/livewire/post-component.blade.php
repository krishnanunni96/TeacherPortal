<div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">Title</label>
                            <div class="col-md-6">
                                <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" autofocus>
                                @error('title')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <label for="slug" class="col-md-2 col-form-label text-md-right">Slug</label>
                            <div class="col-md-6">
                                <input wire:model="slug" type="text" class="form-control">
                            </div>
                        </div>
                
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Post
                                </button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($posts->count())
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->slug }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
