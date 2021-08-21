
	<h3><b style="font-size: 0.875rem;">Xin chào : {{ $full_name }}</b></h3>
	<p><b style="font-size: 0.875rem;">Dưới đây là mã xác thực của bạn : </b>
	</p>
	<table style="width: 100%" border="1" class="table table-bordered">
		<tbody>
			<tr>
                @foreach ($codes as $item)
                    <td style="text-align: center; "><b>{{  $item }}</b>
                    </td>
                @endforeach
			</tr>
		</tbody>
	</table>

