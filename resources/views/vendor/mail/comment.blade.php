@if ($type=='reply')
<p><b>Xin chào </b>: {{ $author_name }}</p>
<p><b>{{ $comment_email }} </b> : <br> Đã trả lời bình luận bài viết của bạn</p>
<p><b>Nội dung bình luận </b>: </p>
<blockquote style="margin-bottom: 1rem;
font-size: 1.0rem;background-color: #fff;
    border-left: .7rem solid #e4b20d;
    margin: 1.5em .7rem;
    padding: .5em .7rem;" class="blockquote">
    {{ $comment }}
</blockquote>
<a href="{{ $url }}">{{ $url }}</a>
@else
<p><b>Xin chào </b>: {{ $author_name }}</p>
<p><b>{{ $comment_email }} </b> : <br> Đã bình luận bài viết của bạn</p>
<p><b>Nội dung bình luận </b>: </p>
<blockquote style="margin-bottom: 1rem;
font-size: 1.0rem;background-color: #fff;
    border-left: .7rem solid #e4b20d;
    margin: 1.5em .7rem;
    padding: .5em .7rem;" class="blockquote">
    {{ $comment }}
</blockquote>
<a href="{{ $url }}">{{ $url }}</a>
@endif



