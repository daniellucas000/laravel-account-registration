@if(session()->has('success'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire('Pronto!', "{{ session('success') }}", 'success');
    });
</script>
@endif

@if ($errors->any())
@php
$mensagem = '';
foreach($errors->all() as $error) {
$mensagem .= $error . '<br>';
}
@endphp
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire('Erro!', "{!! $mensagem !!}", 'error');
    });
</script>
@endif