<div class="content-wrapper">
  <section class="content pt-3">
    <div class="container-fluid">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle mr-1"></i>{{ session('success') }}<button type="button" class="close" data-dismiss="alert">&times;</button></div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle mr-1"></i>{{ session('error') }}<button type="button" class="close" data-dismiss="alert">&times;</button></div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
      @endif
      @include($content)
    </div>
  </section>
</div>
