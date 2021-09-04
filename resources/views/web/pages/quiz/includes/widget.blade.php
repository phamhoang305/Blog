<div class="card">
    <div class="card-body">
        @include('web.pages.quiz.includes.user')
        <table class="table table-bordered table-sm">
            <tr>
                <th colspan="3" class="text-center">Danh sách kết quả</th>
            </tr>
            <tr>
                <td class="text-center">STT</td>
                <td class="text-center">Thông Tin</td>
                <td class="text-center">Ngày</td>
            </tr>
            @php $i=0;@endphp
            @foreach ($test_result as $item)
            @php $i++;@endphp
            <tr>
                <td class="text-center">{{$i}}</td>
                <td class="text-center">
                    {{$item->full_name}}<br>
                    <span class="badge badge-success ">{{$item->true_number}}</span>
                    <span class="badge badge-danger ">{{$item->error_number}}</span>
                    <span class="badge badge-dark ">{{$item->nocheck_number}}</span>
                </td>
                <td class="text-center">{{time_Ago(date_time($item->created_at))}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
