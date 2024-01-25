

<script src="{{ asset('gallery-c') }}/script.js"></script>
<script src="https://kit.fontawesome.com/18c9c6e968.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $('#searchInput').on('keyup', function(){
            var keyword = $(this).val();
            
            $.ajax({
                url: '{{ route("search") }}',
                type: 'GET',
                data: { 'keyword': keyword },
                success:function(data){
                    $('#fotoContainer').html(data);
                }
            });
        });
    });
</script>
</body>
</html>
