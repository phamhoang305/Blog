
	<h3><b style="font-size: 0.875rem;">Xác nhận email của bạn</b></h3>
	<p><b style="font-size: 0.875rem;">Vui lòng xác nhận địa chỉ email của bạn bằng cách nhấp vào nút bên dưới.  </b>
	</p>
    <a href="{{ route('web.confirm.mail') }}?token={{ $email_verified_token }}"
    style="font-size:14px;
    text-decoration:none;
    padding:14px 40px;
    background-color:#1abc9c;
    color:#ffffff!important;
    border-radius:3px"
    >
        Xác nhận email của bạn
    </a>
