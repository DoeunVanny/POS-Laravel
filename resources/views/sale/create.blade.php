@extends('layout')

@section('content')
    
    <div class="container">
         <h3 align='center' class="mt-5">POS</h3>
        
         <div class="row">
            <div class="col-sm-8">
                <form class="form-horizontal" id="frmInvoice">
                    <table class="table table-bordered">
                        <caption> Add Products </caption>
                       
                        <tr>
                            <th>Product code</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>qty</th>
                            <th>Amount</th>
                            <th>option</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" placeholder="Product code" id="barcode" name="barcode" size="25px" required>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="Product name" id="pname" name="pname" size="50px" disabled>
                            </td>
                            <td>
                                <input type="text" class="form-control pro_price" placeholder="Price" id="pro_price" name="pro_price" size="25px" >
                            </td>
                            <td>
                                <input type="number" class="form-control qty" placeholder="Qty" min="1" id="qty" name="qty" value="1" size="10px" >
                            </td>
                            <td>
                                <input type="text" class="form-control pro_price" placeholder="total_cost" id="total_cost" name="total_cost" size="35px" >
                            </td>
                            <td>
                                <button type="button" class="btn btn-success" onclick="addproduct()">Add</button>
                            </td>
                        </tr>
                    </table>
                 </form>
                    <table class="table table-bordered" id="product_list">
                        <caption>Products</caption>
                        <thead>
                            <tr>
                                <th style="width: 40px">Remove</th>
                                <th>Product code </th>
                                <th>Product name </th>
                                <th>Unit Price </th>
                                <th>Qty </th>
                                <th>Amount </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                   </table>              
            </div>
            <div class="col-sm-2">
                  <div class="col s12 m6 offset-m4">
                    <div class="form-group" align="left">
                        <label for="form-label">Total</label>
                        <input type="text" class="form-control" placeholder="Total" id="total" name="total" size="30px" required="">
                    </div>
                    <div class="form-group" align="left">
                        <label for="form-label">Pay</label>
                        <input type="text" class="form-control" placeholder="Pay" id="pay" name="pay" size="30px" required="">
                    </div>
                    <div class="form-group" align="left">
                        <label for="form-label">Balance</label>
                        <input type="text" class="form-control" placeholder="Balance" id="balance" name="balance" size="30px" required="">
                       
                    </div>
                    <!-- <div class="form-group" align="left">
                        <label for="col-sm-2 form-label">Status</label>
                        <select class="form-control" name="payment" id="payment" placeholder="Project status" required >
                        <option value="">please select</option>
                        <option value="1">Cash</option>
                        <option value="2">Cheque</option>
                        </select> -->
                    </div>
                    <div class="card mt-2" align="right" >
                        <button class="btn btn-info" id="save" onclick="addProject()">Update Invoice</button>
                        <!-- <button class="btn btn-warning my-2" id="clear" onclick="reset()">Reset</button>
                        <button class="btn btn-warning" id="clear" onclick="addnew()">save</button> -->
                       
                    </div>

                  </div>
                  </div>
                 
         </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script> 
    
<script>    
    var isNew=true;
    var version_id = null;
    var current_stock=0;
    var product_no =0;
    getProductcode();
    // getCategory();

    function getProductcode() {
        $("#barcode").empty();
        $("#barcode").keyup(function(e){
            var q = $("#barcode").val();
            if($('#barcode').val() == ''){
                $.alert({
                    title: 'Error',
                    content: 'please select customer',
                    type: 'red',
                    autoClose: 'Ok|2000'
                })
                return false;
            }
            $.ajax({
                type: "POST",
                url: '{{ route('search')}}',
                dataType: "JSON",
                headers: {
                    'x-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    barcode: $("#barcode").val(), _token: '{{csrf_token()}}' 
                },
                success: function(data)
                {
                    console.log(data);
                    $("#pname").val(data[0].productname);
                    $("#pro_price").val(data[0].price);
                  },
                  error: function(xhr,status,error){

                  }
                  })
           })
    }
           
    $(function() {
                 $("#pro_price , #qty").on("keydown keyup click", qty);

                 function qty() {
                    var sum = (
                        Number($("#pro_price").val()) * Number($("#qty").val())
                    );
                    $("#total_cost").val(sum);
                    console.log(sum);
                 }
           });
           $(function() {
                 $("#discount , #qty").on("Keydown Keyuo click", discount);

                 function discount() {
                    var sum1 = (
                        Number($("#qty").val()) * Number($("#discount").val())
                    );
                    console.log(sum1);
                 }
           });
           $(function() {
                 $("#total , #pay").on("Keydown Keyuo click", per);

                 function per() {
                    var totalamount =(
                        Number($("#pay").val()) - Number($("#total").val())
                    );
                    $("#balance").val(totalamount);
                    
                 }
           });
           function addproduct(){
        var product = {
            barcode: $("#barcode").val(),
            pname: $("#pname").val(),
            pro_price: $("#pro_price").val(),
            qty: $("#qty").val(),
            total_cost: $("#total_cost").val(),
            button: ' <button class="btn btn-denger btn-xs">delete</button>'
        }
        addRow(product);
        $("#frmInvoice")[0].reset();
     }
     var total =0;
     var discount=0;
     var grosstotal=0;
     var qtye=0;
     var barcode =0;

     function   addRow(product){
        console.log(product.total_cost);
        var $tableB = $("#product_list tbody");
         var $row = $("<tr><td><Button type='button' name='record' class='btn btn-warning btn-xs' name='record' onclick='deleterow(this)' >Delete </td> " +
         "<td>" + product.barcode + "</td> <td class=\"price\">" + product.pname + "</td><td>" + product.pro_price  +"</td><td>" + product.qty + "</td><td>" + product.total_cost + "</td></tr>");
        $row.data("barcode",product.product_code);
        $row.data("pname",product.product_name);
        $row.data("pro_price",product.price);
        $row.data("qty",product.qty);
        $row.data("total_cost",product.total_cost);
        total += Number(product.total_cost);
        $('#total').val(total);
        console.log(product.total_cost);
        qtye += Number(product.qty);
         
        $row.find('deleterow').click(function(event){
            deleteRow($(event.currentTarget).parent('tr'));
        })
        $tableB.append($row);
     }

     function deleterow(e)
     {
        qty_cost = parseInt($(e).parent().parent().find('td:nth-child(5)').text(),10);
        qtye-= qty_cost;

        product_total_cost=parseInt($(e).parent().find('td:last').text(),10);
        total-=product_total_cost;

        $('#total').val(total);

        dis_total_cost = parseInt($(e).parent().find('td:nth-child(6)').text(),10);
        discount -=dis_total_cost;
        
        console.log(discount);

        $('#discounttotal').val(discount);

        grandtotal = total - discount ;
        $('#grandtotal').val(grandtotal);
        $(e).parent().parent().remove();
     }

     function deleteRow(row){
        console.log(product.total_cost);
        total -= Number(product.total_cost);
        $('#tot').val(tot);
        $(row).remove();
        console.log(product.total_cost);
        $(row).remove();
        onRowRemoved();
     }
      
     function addProject() {
        var table_data = [];
        $('#product_list tbody tr ').each(function (row, tr){
            var sub = {
                'barcode' : $(tr).find('td:eq(1)').text(),
                'pname' : $(tr).find('td:eq(2)').text(),
                'pro_price' : $(tr).find('td:eq(3)').text(),
                'qty' : $(tr).find('td:eq(4)').text(),
                'total' : $(tr).find('td:eq(5)').text(),
            };
            table_data.push(sub);
        })
        console.log(table_data);

        var total = $("#total").val();
        var pay = $("#pay").val();
        var balance = $("#balance").val();

        $.ajax({
            type: "POST",
            url: '{{ route('sales_add')}}',
            dataType: "JSON",
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                total: total,
                pay: pay,
                balance: balance,
                products: table_data, _token: '{{csrf_token()}}'
            },
            success: function(data) {
                // console.log(data);
                // if(isNew){
                    alert("sales Addedd");
                // }
                if (data.last_id){
                    var url = "{{ route('print.form',['last_id' => ':last_id'])}}".replace(':last_id', data.last_id);
                    window.location.href = url;
                }else {
                    console.error('last ID is not valid')
                }
            },
            error: function (xhr, status , error){
             alert(xhr.responseText);
             console.log(xhr.responseText);
            }
        });

     }
    
    </script>
    

@endsection