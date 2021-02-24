<!-- jQuery -->
<script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>

<!-- Toastr -->
<script src="{{ asset('assets') }}/plugins/toastr/toastr.min.js"></script>

<!-- Select2 -->
<script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>

@livewireScripts

@if (session('success'))
<script>
  toastr.success("{{ session('success') }}", "Berhasil");
</script>
@endif

@if (session('info'))
<script>
  toastr.info("{{ session('info') }}", "Informasi");
</script>
@endif

@if (session('error'))
<script>
  toastr.error("{{ session('error') }}", "Peringatan");
</script>
@endif

@if (session('warning'))
<script>
  toastr.warning("{{ session('warning') }}", "Perhatian");
</script>
@endif

<script>
  window.livewire.on('success', msg => {
    toastr.success(msg, "Berhasil");
  });
  window.livewire.on('info', msg => {
    toastr.info(msg, "Informasi");
  });
  window.livewire.on('error', msg => {
    toastr.error(msg, "Peringatan");
  });
  window.livewire.on('warning', msg => {
    toastr.warning(msg, "Perhatian");
  });
</script>

@yield('script')
@stack('script')