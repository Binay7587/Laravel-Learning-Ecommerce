<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
<script>
    $('.parallax100').parallax100();

    $('.add-to-cart').click(function(){
        var quantity = $('.num-product').val();
        var prod_id = $(this).data('id');

        $.ajax({
            url: "{{ route('add-to-cart') }}",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                quantity: quantity,
                product_id: prod_id
            },
            success: function(response){
                if(typeof(response) != 'object'){
                    response = $.parseJSON(response);
                }

                if(response.status == false){
                    swal('Error',response.msg,'error').then(function(){
                        document.location.href = document.location.href;
                    });
                } else {
                    swal('Success',response.msg,'success').then(function(){
                        document.location.href = document.location.href;
                    });
                }
            }
        });
    });

    // swal(nameProduct, "is added to cart !", "success");
</script>
{{--<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d46867d06c556ef"></script>--}}
@yield('scripts')
</body>
</html>
