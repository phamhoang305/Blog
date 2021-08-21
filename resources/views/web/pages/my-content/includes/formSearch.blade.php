<form action="">
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" name="q" value="{{$search}}" placeholder="Tìm kiếm ... " />
                    <div class="input-group-append">
                    <button onclick="$('input[name=q]').val('')" class="btn btn-sm btn-outline-danger" type="button">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select class="form-control form-control-sm select2" name="c">
                <option value=""> -- Danh mục -- </option>
                @foreach (getMenu() as $item)
                <option  {{$category==$item->id?'selected':''}} value="{{$item->id}}">{{$item->cate_name}}</option>
                        @if (count($item->sub_menu)>0)
                            @foreach ($item->sub_menu as $sub)
                            <option {{$category==$sub->id?'selected':''}} value="{{$sub->id}}">&nbsp;&nbsp;&nbsp; - {{$sub->cate_name}}</option>
                            @endforeach
                        @endif
                    @endforeach
            </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-outline-info btn-block">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form>
