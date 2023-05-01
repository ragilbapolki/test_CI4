<?= $this->extend('layout/templates'); ?>

<?= $this->Section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"></h1>
            <div class="card mb-4">
                <div class="card-header">
                <i class="fas fa-file"></i>
                    <?= $title; ?> 
                </div>
                <?= csrf_field(); ?>
                <div class="card-body">
                    <form id="form-detail">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="date" class="col-sm-12 col-form-label"><strong>Date</strong></label>
                                <div class="col-sm-12">
                                    <input type="text" style="width: 90%;" class="form-control" id="date" name="date" readonly  value="<?= date("d M Y")?>" placeholder="type date here" title="Input Date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date" class="col-sm-12 col-form-label"><strong>Product</strong></label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="products" id="products" title="Select Products">
                                        <?php foreach($data_products as $data_products){ ?>
                                            <option value="<?php echo $data_products['id']; ?>"><?php echo $data_products['barcode'] . ' - '. $data_products['name'] ; ?></option>';
                                        <?php } ?>
                                    </select>
                                    <div class="col-sm-12 div-product" style="display:none">
                                        <label for="stock" style="display:none" class="col-sm- col-form-label div-product">Stock</label> :
                                        <a class="col-sm-5 stock-product">
                                        </a>
                                    </div>
                                    <input type="hidden" class="form-control" id="id" name="id">
                                    <input type="hidden" class="form-control" id="barcode" name="barcode">
                                    <input type="hidden" class="form-control" id="name_product" name="name_product">
                                    <input type="hidden" class="form-control" id="price" name="price">
                                    <input type="hidden" class="form-control" id="index" name="index">
                                    <input type="hidden" class="form-control" id="no" name="no" value="<?= $no_invoice; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="date" class="col-sm-12 col-form-label"><strong>Customer</strong></label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="customer" id="customer" title="Select Customer">
                                        <?php foreach($customer as $customer){ ?>
                                            <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name'] ; ?></option>';
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date" class="col-sm-12 col-form-label"><strong>Quantity</strong></label>
                                <div class="col-sm-12">
                                    <input type="number" style="width: 90%;" class="form-control" id="quantity" name="quantity" placeholder="type quantity here" title="Input Quantity">
                                    <input type="hidden" class="form-control col-sm-5" id="total" name="total" placeholder="type quantity here" title="Input Quantity">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <label for="date" class="col-form-label"><strong>No Invoice</strong> : <?= $no_invoice; ?></label>
                            </div>
                            <div class="row">
                                <h1><strong style="color:#128502"><a class="total-price"></a></strong></h1>
                            </div>
                        </div>
                    </div>
                    </form>
                    <button type="submit" class="btn btn-primary btn-sm btn-add" disabled>Add</button>
                    <button type="submit" class="btn btn-success btn-sm btn-pay-modal" disabled>Pay</button>
                    </br>
                    </br>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered" id="tblDetailOrder" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="display:none">Id</th>
                                        <th>Barcode</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Get Modal -->
    <div class="view-modal">
        <!-- Modal -->
        <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="form-pay">
                    <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="type" class="col-sm-4 col-form-label">Moneys</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" id="moneys" name="moneys" placeholder="type moneys here" title="Input Moneys">
                                <div class="invalid-feedback errormoneys">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-4 col-form-label">Total Payment</label>
                            <div class="col-sm-8 col-form-label">
                                <a class="col-sm-5 total-payment"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-4 col-form-label">Change</label>
                            <div class="col-sm-8 col-form-label">
                                <a class="col-sm-5 kembalian"></a>
                            </div>
                        </div>
                    <input type="hidden" class="form-control" id="total_payment" name="total_payment">
                    <input type="hidden" class="form-control" id="no_invoice" name="no_invoice">
                    <input type="hidden" class="form-control" id="change" name="change">
                    <input type="hidden" class="form-control" id="customer_id" name="customer_id">
                    <input type="hidden" class="form-control" id="order_id" name="order_id">
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm btn-pay" value="save">Pay</button>
                        <button type="submit" class="btn btn-success btn-sm btn-pay-print" value="print">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#products').on('select2:select', function(e) {
                p_product = $(this).val()
                getFirstData(p_product);
            })
            $(".select2").select2({
                placeholder: 'Select Item',
                width: '90%'
            }).val('').trigger('change');

            $(".btn-add").on("click", function (e) {
                e.preventDefault();
                let data       = $("#form-detail").serializeArray();
                addRow(data, 'add');
                $('.div-product').hide()
                $('.stock-product').empty()
                $(".btn-add").attr("disabled", true)
                $("#quantity").val('')
                $("#products").val('').trigger('change');
            });
            
            $("#quantity").keyup(function(){
                let val_price   = $("#price").val()
                let val_quantity= $(this).val()
                let val_total   = $("#total").val() == null ||  $("#total").val() == '' ? 0 : $("#total").val()
                let total_price = parseInt(val_price) * parseInt(val_quantity)
                let sum         = parseInt(val_total) + parseInt(total_price)
                $("#total").val(sum)
                if (val_quantity == 0 || val_quantity == null) {
                    $(".btn-add").attr("disabled", true)
                } else {
                    $(".btn-add").attr("disabled", false)
                }
            });

            $("#tblDetailOrder tbody").on("click", ".detele-item", function (e) {
                let index      = tblDetailOrder.row($(this).parent().parent());
                tblDetailOrder.row( index ).remove().draw();
                $("#total").val('')
                $('.total-price').empty()
            })

            addRow = (data, type) => { 
                let datatable  = [];
                let exists     = false;
                let id         = data[1].value;
                let barcode    = data[3].value;
                let product    = data[4].value;
                let price      = parseInt(data[5].value);
                let quantity   = parseInt(data[9].value);
                let total      = price*quantity

                if (exists == false) {
                    if (type == 'add') {
                        tblDetailOrder.row.add([id, barcode, product, price, quantity, total]).draw();
                        toastr.success("Item added !");
                    } 
                } else {
                    toastr.warning("Sorry, input different date!");
                }
            }

            var tblDetailOrder = $('#tblDetailOrder').DataTable({
                responsive  : true,
                searching   : false,
                lengthchange: false,
                scrollY     : 160,
                ordering    : false,
                bPaginate   : false,
                columnDefs: [
                    {"visible": false, "targets": [0]}
                ],
                columns: [{
                        name          : 'id',
                        defaultContent: ""
                    },{
                        name          : 'barcode',
                        defaultContent: ""
                    },{
                        name          : 'product',
                        defaultContent: ""
                    },{
                        name          : 'price',
                        defaultContent: ""
                    },{
                        name          : 'quantity',
                        defaultContent: ""
                    },{
                        name          : 'total',
                        defaultContent: ""
                    },{
                        name          : 'action',
                        defaultContent: `
                        <button class="btn btn-danger btn-sm mb-1 detele-item" title="Delete">
                            <i class="fas fa-trash"></i> 
                         </button>
                        `
                    }
                ],
                "drawCallback": function( settings ) {
                    let tbl = tblDetailOrder
                    if (tbl == null) {
                        $(".btn-pay-modal").attr("disabled", true)
                    } else {
                        let count_data = tblDetailOrder.data().count()
                        if (count_data == 0) {
                            $(".btn-pay-modal").attr("disabled", true)
                        } else {
                            $(".btn-pay-modal").attr("disabled", false)
                        }
                    }
                }
            });
            
            $('.btn-pay-modal').click(function(e) {
                var dtl = tblDetailOrder.rows().data().toArray();
                var sum  = 0
                dtl.map(function (obj) {
                    sum += obj[5]
                });
                $('#payModal').modal('show')
                $('#payModal').find("#total_payment").val(sum)
                $('#payModal').find("#no_invoice").val($("#no").val())
                $('#payModal').find("#customer_id").val($("#customer").val())
                $('#payModal').find('.total-payment').empty()
                $('#payModal').find(".total-payment").append(sum)
                $('#payModal').find('.kembalian').empty()
                $('#payModal').find(".kembalian").append(0)
            });
            
            $("#moneys").keyup(function(){
                let val_total_payment   = $("#total_payment").val()
                let val_moneys          = $("#moneys").val() == null ||  $("#moneys").val() == '' ? 0 : $("#moneys").val()
                let set_change          = parseInt(val_moneys) - parseInt(val_total_payment)
                $("#change").val(set_change)
                $('.kembalian').empty()
                $('.kembalian').append(set_change)
            });
            $('.btn-pay,.btn-pay-print').click(function(e) {
                let formData      = new FormData($("#form-pay")[0]);
                let dtlData       = tblDetailOrder.rows().data().toArray();
                let url           = "<?= base_url('transaction/order/save_data') ?>"
                let type_btn      = $(this).val()

                formData.append("type_btn", type_btn)
                dtlData.map(function (obj) {
                    formData.append("detail[]", obj);
                });

                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType   : "json",
                    beforeSend: function() {
                        $('.btn-pay').attr('disable', 'disabled');
                        $('.btn-pay-print').attr('disable', 'disabled');
                        $('.btn-pay').html('<i class="fas fa-spin fa-spinner"></i>');
                        $('.btn-pay-print').html('<i class="fas fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.btn-pay').removeAttr('disable');
                        $('.btn-pay-print').removeAttr('disable');
                        $('.btn-pay').html('Pay');
                        $('.btn-pay-print').html('Print');
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 800
                        })
                        $('#payModal').modal('hide');
                        tblDetailOrder.clear().draw();
                        $(".select2").val('').trigger('change');
                        $("#order_id").val(id)
                        if (type_btn == 'print') {
                            printInvoice(response.id)
                        }
                    }
                });
                return false;
            });
        });
        
        getFirstData = (p_product) => {
            $.ajax({
                url: "<?= base_url('master/products/get_first_data') ?>",
                data: { 
                    p_product: p_product
                }, 
                dataType: "json",
                success: function(response) {
                    $('.div-product').show()
                    $('.stock-product').empty()
                    $('.stock-product').append(response.stock)
                    $("#id").val(response.id)
                    $("#barcode").val(response.barcode)
                    $("#name_product").val(response.name)
                    $("#price").val(response.price)
                    if (response.stock == 0) {
                        $(".btn-add").attr("disabled", true)
                    } else {
                        $(".btn-add").attr("disabled", false)
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }
        
        printInvoice = (id) => {
            $.ajax({
                url: "<?= base_url('report/print_invoice'); ?>",
                data: {
                    id: id
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Invoice .pdf";
                    link.click();
                },
            });
        }
    </script>

    <?= $this->endSection(); ?>