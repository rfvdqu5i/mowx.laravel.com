<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <title>Danh sách sản phẩm</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet"/>
    <style type="text/css" media="screen">
        .form-group input {
            margin-bottom: 10px;
        }
    </style>

</head>

<body class="container">

    <div class="main">
        <h2 align="center">DANH SÁCH SẢN PHẨM</h2>
        <hr>
        <a href="{{ route('product.store') }}" class="btn btn-primary btn-add">Thêm mới</a>
        <hr>
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($products as $product)
                <?php $i++ ; ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td>{{$product->product_code}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_quantity}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-show" data-url="{{ route('product.show',$product->id) }}"​>Details</button>
                            <button type="button" class="btn btn-success btn-edit" data-url="{{ route('product.edit',$product->id) }}"​>Edit</button>
                            <button type="submit" class="btn btn-danger btn-delete" data-url="{{ route('product.destroy',$product->id) }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br> <br>
    </div>

    {{-- Modal show chi tiết todo --}}
    <div class="modal fade" id="modal-show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Show todo</h4>
                </div>
                <div class="modal-body">
                    <h2>Product:</h2>
                    <h4 id="code"></h4>
                    <h4 id="name"></h4>
                    <h4 id="price"></h4>
                    <h4 id="quantity"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Thêm mới --}}
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="" data-url="{{ route('product.store') }}" id="form-add" method="POST" role="form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add product</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Product</label>
                            <input type="text" class="form-control" id="product_code" placeholder="Nhập mã sản phẩm">
                            <input type="text" class="form-control" id="product_name" placeholder="Nhập tên sản phẩm">
                            <input type="text" class="form-control" id="product_price" placeholder="Nhập giá bán">
                            <input type="text" class="form-control" id="product_quantity" placeholder="Nhập số lượng sản phẩm">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal sửa todo --}}
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form action="" id="form-edit" method="POST" role="form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Edit product</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="">Product</label>
                                <input type="text" class="form-control" id="code_edit" placeholder="Nhập mã sản phẩm">
                                <input type="text" class="form-control" id="name_edit" placeholder="Nhập tên sản phẩm">
                                <input type="text" class="form-control" id="price_edit" placeholder="Nhập giá sản phẩm">
                                <input type="text" class="form-control" id="quantity_edit" placeholder="Nhập số lượng sản phẩm">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            //code ajax ta sẽ viết ở đây
            //xem chi tiết
            $('.btn-show').click(function () {
                //hiện modal show lên
                $('#modal-show').modal('show');
                //lấy dữ liệu từ attribute data-url lưu vào biến url
                var url=$(this).attr('data-url');
                $.ajax({
                    //sử dụng phương thức get
                    type: 'get',
                    url: url,
                    //nếu thực hiện thành công thì chạy vào success
                    success: function (response) {
                        //hiển thị dữ liệu được controller trả về vào trong modal
                        $('#code').text(response.data.product_code);
                        $('#name').text(response.data.product_name);
                        $('#price').text(response.data.product_price);
                        $('#quantity').text(response.data.product_quantity);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //xử lý lỗi tại đây
                    }
                })
            });

            //bắt sự kiện click vào nút add
            $('.btn-add').click(function (e) {
                e.preventDefault();
                //hiện modal show
                $('#modal-add').modal('show');
            })

            //bắt sự kiện submit form thêm mới
            $('#form-add').submit(function (e) {
                e.preventDefault();
                //lấy attribute data-url của form lưu vào biến url
                var url=$(this).attr('data-url');
                $.ajax({
                    //sử dụng phương thức post
                    type: 'post',
                    url: url,
                    data: {
                        //lấy dữ liệu từ ô input trong form thêm mới
                        product_code: $('#product_code').val(),
                        product_name: $('#product_name').val(),
                        product_price: $('#product_price').val(),
                        product_quantity: $('#product_quantity').val(),
                    },
                    success: function (response) {
                        // hiện thông báo thêm mới thành công bằng toastr
                        toastr.success('Add new todo success!');
                        console.log($('#code').val(),'ưqeqweqwe');
                        //ẩn modal add đi
                        $('#modal-add').modal('hide');
                        setTimeout(function () {
                            window.location.href="{{ route('product.index') }}";
                        },800);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //xử lý lỗi tại đây
                    }
                })
            })

            $('.btn-delete').click(function () {
                //lấy attribute data-url của nút xoá lưu vào url
                var url=$(this).attr('data-url');
                //hiển thị dialogbox xác nhận xoá
                if (confirm("Are you sure?")){
                    $.ajax({
                        //phương thức delete
                        type: 'delete',
                        url: url,
                        success: function (response) {
                            //thông báo xoá thành công bằng toastr
                            toastr.warning('delete todo success!')
                            setTimeout(function () {
                                window.location.href="{{ route('product.index') }}";
                            },800);
                        },
                        error: function (error) {
                            
                        }
                    })
                }
            })

            //bắt sự kiện click vào nút edit
            $('.btn-edit').click(function (e) {
                //mở modal edit lên
                $('#modal-edit').modal('show');
                e.preventDefault();
                //lấy data-url của nút edit
                var url=$(this).attr('data-url');
                $.ajax({
                    //phương thức get
                    type: 'get',
                    url: url,
                    success: function (response) {
                        //đưa dữ liệu controller gửi về điền vào input trong form edit.
                        $('#code_edit').val(response.data.product_code);
                        $('#name_edit').val(response.data.product_name);
                        $('#price_edit').val(response.data.product_price);
                        $('#quantity_edit').val(response.data.product_quantity);
                        //thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
                        $('#form-edit').attr('data-url','{{ asset('product/') }}/'+response.data.id)
                    },
                    error: function (error) {
                        
                    }
                })
            })

            //bắt sự kiện submit form edit
            $('#form-edit').submit(function (e) {
                e.preventDefault();
                //lấy data-url của form edit
                var url=$(this).attr('data-url');
                $.ajax({
                    //phương thức put
                    type: 'put',
                    url: url,
                    //lấy dữ liệu trong form
                    data: {
                        product_code: $('#code_edit').val(),
                        product_name: $('#name_edit').val(),
                        product_price: $('#price_edit').val(),
                        product_quantity: $('#quantity_edit').val(),
                    },
                    success: function (response) {
                        //thông báo update thành công
                        toastr.success('edit todo success!')
                        //ẩn modal edit
                        $('#modal-edit').modal('hide');
                        setTimeout(function () {
                            window.location.href="{{ route('product.index') }}";
                        },800);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //xử lý lỗi tại đây
                    }
                })
            })
        });
    </script>

</html>