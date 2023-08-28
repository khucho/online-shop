$(document).ready(function(){


    $('.add_to_cart').on('click',function(event){
        event.preventDefault();
        
            let id = $(this).parent().attr('id');

            $.ajax({
                method: 'post',
                url: 'addCart.php',
                data : {id:id},
                success: function(response)
                {
                    alert(response);
                    location.href = 'shop.php';
                },
                error:function(error){
                    alert(error);
                }
            })
    })


    $('.add_cart').on('click',function(event){
        event.preventDefault();
        
            let id = $(this).parent().attr('id');
            $qty = $(this).parents('.row').find('#qty').val();

            $.ajax({
                method: 'post',
                url: 'addCart.php',
                data : {id:id,qty:$qty},
                success: function(response)
                {
                    alert(response);
                    location.href = 'productDetail.php?productId='+id+'';
                },
                error:function(error){
                    alert(error);
                }
            })
    })

    

    $('.btn-plus').on('click',function(event){
        event.preventDefault();     

        $parent = $(this).parents('tr');

        $unitPrice = $parent.find('#price').val();

        $qty = Number($parent.find('#qty').val()) + 1;
        

        $parent.find('#qty').val($qty);
       
        $total = $unitPrice * $qty ;

        $parent.find('#totalPrice').html($total);

        
        let $totalPrice = 0 ;
        $('#itemTable #itemData').each(function(index,row)
        {
           $totalPrice += Number($(row).find('#totalPrice').html());
        })

        $('#subTotal').html($totalPrice);
        $('#total').html($totalPrice + 10 );
    })

    $('.btn-minus').on('click',function(event){
        event.preventDefault();
        

        $parent = $(this).parents('tr');

        $unitPrice = $parent.find('#price').val();
        $qty = Number($parent.find('#qty').val()) - 1;


        if ($qty >= 1)
        {
            $parent.find('#qty').val($qty);
       
            $total = $unitPrice * $qty ;

            $parent.find('#totalPrice').html($total);

            

            let $totalPrice = 0 ;
            $('#itemTable #itemData').each(function(index,row)
            {
               $totalPrice += Number($(row).find('#totalPrice').html());
            })

            $('#subTotal').html($totalPrice);
            $('#total').html($totalPrice + 10 );
        }
       
        
    })

    $('.btn-remove').on('click',function(event){
        event.preventDefault();

        let $id = $(this).attr('id');
        console.log($id);
        
        $.ajax({
            method : 'post',
            url : 'removeCart.php',
            data : {id:$id},

            success : function (response)
            {
                alert(response);
                location.href = 'cart.php';
            },

            error : function (error)
            {
                alert(error);
            }
        })

        // $(this).parents('.row').find('#itemData').remove();
    })

    $('.btn-increase').on('click',function(event){
        event.preventDefault();
        
       $qty = Number($(this).parent().find('#qty').val()) + 1 ;

       $(this).parent().find('#qty').val($qty);
    })

    $('.btn-decrease').on('click',function(event){
        event.preventDefault();
        
        $qty = Number($(this).parent().find('#qty').val()) - 1 ;

        if ($qty >= 1)
        {
            $(this).parent().find('#qty').val($qty);
        }

        
    })

    $('#orderBtn').on('click',function(){
        
        $data = [];

        $('#itemTable #itemData').each(function(index,row)
        {
           if ($(row).find('#checkBox').is(':checked'))
           {

            $data.push({
                'product_id' : $(row).find('#checkBox').val() ,
                'quantity' : $(row).find('#qty').val(),
                'total_price' : $(row).find('#totalPrice').html()
            })
    
           }
        })
        
        if ($data.length == 0)
        {
            
            alert('Please select item');
        }
        else 
        {
            $vcCode = $('#voucher_code').val();

            $vcCode = $('#voucher_code').val();
            if ($vcCode == '')
            {
                alert('Enter Voucher Code')
            }
            else 
            {
                $.ajax({
                    method: 'post',
                    url: 'addOrder.php',
                    data : {data:$data,vcCode:$vcCode},
                    success: function(response)
                    {
                        alert(response);
                        location.href = 'cart.php';
                    },
                    error:function(error){
                        alert(error);
                    }
                })
            }
    
            
        }

        

    })

    // $('#city').change(function(){
    //     let val = $(this).val();
        
    //     let row = '<?php foreach($townships as $township) : ?>';
    //     row += '<?php if ($township["city_id"] == 1 )  : ?>';
    //     row += '<option value="<?php echo $township["id"]?>">';
    //     row += '<?php echo $township["name"] ?>';
    //     row += '</option>';
    //     row += '<?php endif; ?>';
    //     row += '<?php endforeach; ?>';

    //     $('#township').append(row);
    // })
})