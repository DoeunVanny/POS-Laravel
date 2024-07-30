<!DOCTYPE html>
<head>
    
</head>
<body>
    
</body>
</html>

<!DOCTYPE html>
<html>
<head>
     <title>Print Receipt</title>
       <style>
       body {
        font-family: monospace;
       }
       .container {
        width: 80mm;
        margin: 0 auth;
        text-align: left;
       }
       .invoice-title{
          margin-bottom: 5px;
       }
       .invoice-title h1{
        font-size: 16px;
         margin:0;
       }
       table {
        width: 100%;
        border-collapse: collapse;
       }
       th,td{
        border: 1px solid #000;
        padding: 3px;
        text-align: center
       }
       .text-right{
        text-align: center;
        margin-top: 10px;
       }

       </style>
</head>
  <body>
          <div class="container">
                  <div class="invoice-title">
                    <h1>Zhe Yaun</h1>

                  </div>
                  <div class="invoice-title">
                      Order #: <b>{{$sales_id}}</b>

                  </div>
                  <div class="invoice-title">
                    Date : <b>{{date('d-m-y H:i:s')}}</b>

                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pname</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($saleDetails as $index => $detail)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$detail->product->productname}}</td>
                                <td>{{$detail->qty}}</td>
                                <td>{{$detail->price}}</td>
                                <td class="text-right">{{$detail->total_cost}}</td>
                            </tr>  
                        @endforeach

                    </tbody>
                </table>
                <div class="footer">
                      Sub Totial: <b>{{$grand_total}}</b> | pay: <b>{{$pay}}</b> | Due <b>{{$balance}}</b>
                </div>
                <div class="footer">
                    60 b bank road badulla
                </div>
          </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script> 
  
  <script>
       $(document).ready(function() {
          myFunction();
          window.onafterprint = function(e){
             closePrintView();
          };
       });

       function myFunction(){
        window.print();
       }

       function closePrintView(){
        window.location.href = '{{route('sale.index')}}' ;
       }
  </script>
</html>