<br>
<section class="content">
        @if (session('status_login'))
            <div class="alert alert-danger text-small alert-dismissible" role="alert"> <i class="icon fas fa-exclamation-triangle"></i> {{session('status_login')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-danger text-small alert-dismissible" role="alert"> <i class="icon fas fa-exclamation-triangle"></i> {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
        @endif
        @if (session('status_confirmMail'))
                <div class="alert alert-success text-small alert-dismissible" role="alert"> <i class="icon fas fa-check"></i> {{session('status_confirmMail')}}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
        @endif
</section>
