@extends(!Request::ajax() ? 'layout.admin.index' : 'layout.empty' )
@section('content')
   @include('layout.errors.notifications')
   <table id="simple-table" class="table table-bordered table-hover">
      <thead>
      <tr class="info">
         <th class="center">
            #
         </th>
         <th class="center">Product Name</th>
         <th class="center">Size</th>
         <th class="center">Color</th>
         <th class="center">Product SKU</th>
         <th class="center">Product Price</th>
         <th class="center">Discount</th>
         <th class="center">Quantity</th>
         <th class="center">Total Price</th>
         <th class="center">Create Date</th>
         <th class="center">Operations</th>
      </tr>
      </thead>
      <tbody>
      @forelse($detailsOrder as $key=> $d_order)
         <tr>
            <td class="center">{{$key+1}}</td>
            <td class="center"><a class="click_me" data-path="/admin/product/{{ $d_order->products()->product_id }}" href="{{ route('product.show',$d_order->products()->product_id) }}">
                  {{($d_order->products()->product_name)}}</a></td>
            <td class="center">{{$d_order->size}}</td>
            <td class="center">{{$d_order->color}}</td>
            <td class="center">{{$d_order->product_sku}}</td>
            <td class="center">{{$d_order->product_price}}</td>
            <td class="center">{{$d_order->discount}}</td>
            <td class="center">{{$d_order->quantity}}</td>
            <td class="center">{{$d_order->total_price}}</td>
            <td class="center">{{$d_order->created_at}}</td>
            <td class="center">
               <div class="hidden-sm hidden-xs btn-group">
                  <form>
                     <button class="btn btn-xs btn-danger delete_me" data-id="{{ $d_order->details_order_id }}">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                     </button>
                  </form>
               </div>
            </td>
         </tr>
      @empty
         <tr>
            <td colspan="11">No Data</td>
         </tr>
      @endforelse
      </tbody>
   </table>

   <script>
       $(document).ready(function () {
           $(".delete_me").click(function (e) {
               e.preventDefault();
               if (!confirm('ARE YOU SURE TO DELETE IT?')){
                   return false
               }
               var obj = $(this); // first store $(this) in obj
               var id = $(this).data("id");
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                   }
               });
               $.ajax({
                   url: "/admin/orders/" + id,
                   method: "post",
                   dataType: "Json",
                   data: {"id": id},
                   success: function ($results) {
                       alert('Order Details Has Been successfully Deleted');
                       history.back();
                   },
                   error: function (xhr) {
                       alert('error,Order Details not deleted');
                       console.log(xhr.responseText);
                   }
               });
           });
       });
   </script>
@endsection