
<div class="card">
    <div class="card-header">
        <h3>Edit Comment</h3>
    </div>
    <div class="card-body">

        @if($errors->any())
            <ul class="nostyle">
                @foreach($errors->all() as $error)
                    <li class="alert alert-danger">{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{route('comments.update',[$comment->news_id, $comment->id])}}" method="POST">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" value="{{$comment->username}}">
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <input class="form-control" type="text" name="comment" value="{{$comment->comment_text}}">
            </div>
            <input type="submit" value="Post" class="btn btn-primary">
        </form>
    </div>
</div>
