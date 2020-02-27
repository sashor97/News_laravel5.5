<div class="card">
    <div class="card-header">
        <h3>Create New Article</h3>
    </div>
    <div class="card-body">

        @if($errors->any())
            <ul class="nostyle">
                @foreach($errors->all() as $error)
                    <li class="alert alert-danger">{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{route('news.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <input type="submit" value="Post" class="btn btn-primary">
        </form>
    </div>
</div>
