
    <!-- Include jQuery -->

    
    
    <!-- Include SmartCart -->

   <!-- <script src="{{asset('dist/js')}}/jquery.smartCart.min.js" type="text/javascript"></script>-->

    <!-- Initialize -->







        $(document).ready(function(){ 

            var arlene2=[];

            var producnts=[];

            $(".button").click(function(){

                var stuff = $(this).data('stuff');

                var name=parseInt(stuff[1]);

                var g = arlene2.indexOf(name);
                

                    if(g == -1) {

                       arlene2.push(name);


                       html ="<div id="+stuff[1]+"><div class='price-bg' style='background: #f5f5f5;padding: 3px 14px;padding: 10px 16px;font-weight:bold;'>"+stuff[0]+"</div></div><div class='row inpuu'><div class='col-md-1'> <img class='imgg' src='http://www.husson.edu/facultydirectory/_files/images/faculty%20staff%20profile%20photos/icon-fb.svg'></div><div class='col-md-5'><span>"+stuff[4]+"</span></div><div class='col-md-2'><input class='d_quantity tex' name='quantity[]' type='text' value='1 '/><input   type='hidden' value='"+stuff[3]+"' name='actual_price[]' class='actual_price'/></div><div class='col-md-3' style='padding: 0;'><span class='p_price' style='font-size:1.5em;float: right;'>"+stuff[3]+"</span></div><div class='col-md-1'><i class='fa fa-times cancel' aria-hidden='true'><input class='p_id' type='hidden' name='p_id[]' value='"+stuff[2]+"'/><input class='b_id' type='hidden' name='b_id[]' value='"+name+"'/></i></div></div></div>"

                        $(html).hide().appendTo("#list").fadeIn(1000);



                       //$("#list").append()fadeIn(1000);

                       product=parseInt(stuff[2]);
                       var full_product=product+":"+name;
                        var subtotal=parseFloat($('#actual_subtotal').val())+parseFloat(stuff[3]);
                        $('#actual_subtotal').val(subtotal.toFixed(2));
                        $('#subtotal').text(subtotal.toFixed(2));
                        $('#total').text(subtotal.toFixed(2));
                       producnts.push(full_product);
                       total_pro=parseInt($(".sc-cart-count").text());
                       $(".sc-cart-count").text(total_pro+1);
                        ////////////////////////////Discount////////////////////////////
                        var discount= $("#discount").val();
                        var ac_pricce=$('#actual_subtotal').val();
                        var calcPrice  = (ac_pricce-( ac_pricce * discount / 100 )).toFixed(2);
                        $('#total').text( calcPrice );
                        $('#total_hidden').val( calcPrice );
                        ////////////////////////////////////////////////////////////
                    }

                    else 

                    {    

                        product=parseInt(stuff[2]);
                        var full_product=product+":"+name;
                        var g1 = producnts.indexOf(full_product);

                        if(g1==-1)
                        { 
                            
                            html="<div id=r"+stuff[1]+"><div  class='row inpuu'><div class='col-md-1'><img class='imgg' src='http://www.husson.edu/facultydirectory/_files/images/faculty%20staff%20profile%20photos/icon-fb.svg'></div><div class='col-md-5'>"+stuff[4]+"</div><div class='col-md-2'><input   type='text' value='1' name='quantity[]' class='d_quantity tex'/><input   type='hidden' value='"+stuff[3]+"' name='actual_price[]' class='actual_price'/></div><div class='col-md-3' style='padding: 0;'><span class='p_price' style='font-size:1.5em;float: right;'>"+stuff[3]+"</span></div><div class='col-md-1'><i class='fa fa-times cancel' aria-hidden='true'><input class='p_id' type='hidden' name='p_id[]' value='"+stuff[2]+"'/><input class='b_id' type='hidden' name='b_id[]' value='"+name+"'/></i></div></div></div><hr>";
                            $(html).hide().appendTo("#"+stuff[1]).fadeIn(1000);

                           // $("#"+stuff[1]).append();

                            var subtotal=parseFloat($('#actual_subtotal').val())+parseFloat(stuff[3]);
                            $('#actual_subtotal').val(subtotal.toFixed(2));
                            $('#subtotal').text(subtotal.toFixed(2));
                            $('#total').text(subtotal.toFixed(2));
                            total_pro=parseInt($(".sc-cart-count").text());
                            $(".sc-cart-count").text(total_pro+1);
                            ////////////////////////////Discount////////////////////////////
                            var discount= $("#discount").val();
                            var ac_pricce=$('#actual_subtotal').val();
                            var calcPrice  = (ac_pricce-( ac_pricce * discount / 100 )).toFixed(2);
                            $('#total').text( calcPrice );
                            $('#total_hidden').val( calcPrice );
                            ////////////////////////////////////////////////////////////
                        }
                        else
                        {
                            alert("already in list");
                        }
                         producnts.push(full_product);                       

                    }
            });







            $(document).on('keyup', '.d_quantity', function () {
               var qun= $(this).val();
               if(qun==''){
                qun=1;
               }
              var actual_price=parseFloat($(this).siblings('.actual_price').attr('value'));  

              //var final_product_price=qun*actual_price;  
              var pricee=$(this).parent('div').next('div').text();
               var pric=parseFloat(pricee);

               var final_price=pric*qun;
               $(this).parent('div').next('div').html("<span class='p_price' style='float:right;font-size:1.5em;'>"+(actual_price*qun)+ "</span><i class='fa fa-times' aria-hidden='true'  style='float:right;margin: -8px -25px;'></i>");  
                var subtotal=parseFloat($('#actual_subtotal').val())+parseFloat((actual_price*qun)-pric);               
                $('#actual_subtotal').val(subtotal.toFixed(2));

                ////////////////////////////Discount////////////////////////////
                var discount= $("#discount").val();
                var ac_pricce=$('#actual_subtotal').val();
                var calcPrice  = (ac_pricce-( ac_pricce * discount / 100 )).toFixed(2);
                $('#total').text( calcPrice );
                $('#total_hidden').text( calcPrice );
                ////////////////////////////////////////////////////////////


                $('#subtotal').text(subtotal.toFixed(2));
            });

              /* $(document).on('click', '.fa-times', function () {
                     var div_id=$(this).parent().parent().parent().attr('id');
                     $("#"+div_id).remove();
                });
                */

                $(document).on('click', '.fa-times', function () {

                   var val=parseFloat($(this).parent('div').prev('div').text());
                   //alert(val);
                    //subtract val from total 

                   p_id=$(this).children('.p_id').val();
                   b_id=$(this).children('.b_id').val();
                   delete_val=p_id+":"+b_id;
                   removeItem = delete_val;
                   var g1 = producnts.indexOf(delete_val);

                   if(g1!=-1)
                   {
                    $(this).parent('div').parent('div').fadeOut()
                        .queue(function(nxt) { 
                            $(this).remove();
                            nxt();
                        });


                        producnts = jQuery.grep(producnts, function(value) {
                           
                                return value != removeItem;
                        });

                        /**************************************************************************************/
                            actual_total=parseFloat($("#actual_subtotal").val());                               
                            $("#actual_subtotal").val(actual_total-val);                                                     
                            $("#subtotal").text(actual_total-val);
                               total_pro=parseInt($(".sc-cart-count").text());
                            $(".sc-cart-count").text(total_pro-1);
                        /**************************************************************************************/
                       ////////////////////////////Discount////////////////////////////

                       var discount= $("#discount").val();
                       var ac_pricce=$('#actual_subtotal').val();

                       var calcPrice  = (ac_pricce-( ac_pricce * discount / 100 )).toFixed(2);
                       $('#total').text( calcPrice );
                       $('#total_hidden').val( calcPrice );
                       ////////////////////////////////////////////////////////////

                    }

                   // $(this).parent('div').parent('div').remove();



                });

               // $(document).on('click', '.fa-times', function () {
               //     alert("Umar Farooq");
               // });


            // Initialize Smart Cart      

           // $('#smartcart').smartCart();

            $(document).on('keyup', '#discount', function () {
                var discount= $(this).val();
                var ac_pricce=$('#actual_subtotal').val();

                var calcPrice  = (ac_pricce-( ac_pricce * discount / 100 )).toFixed(2);
                $('#total').text( calcPrice );
                $('#total_hidden').val( calcPrice );





            });

    });




        $( function() {
            $( "#datepicker" ).datepicker();
        } );










    <!-- Include Date Range Picker -->