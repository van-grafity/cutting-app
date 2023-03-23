@extends('layouts.master')

@section('title', 'Color')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-1">
                        <a href="javascript:void(0);" class="btn btn-success mb-2" id="btn_modal_create" data-id='2'>Create</a>
                    </div>
                    <table class="table table-bordered table-hover" id="color_table">
                        <thead class="">
                            <tr>
                                <th scope="col" style="width: 70px;">#</th>
                                <th scope="col" class="text-left">Color</th>
                                <th scope="col" class="text-left">Code</th>
                                <th scope="col" class="text-left">Action</th>
                            </tr>
                        </thead>
                        <!-- <tbody>
                        </tbody> -->
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Section -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_formLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_formLabel">Add Color</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('color.store') }}" method="POST" class="custom-validation" enctype="multipart/form-data" id="color_form">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="color_name">Color</label>
                            <input type="text" class="form-control" id="color_name" name="color" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="color_code">Code</label>
                            <input type="text" class="form-control" id="color_code" name="color_code" placeholder="Enter code">
                        </div>
                    </div>
                    <!-- END .card-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit">Add Color</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#btn_modal_create').click((e) => {
        $('#modal_formLabel').text("Add Color")
        $('#btn_submit').text("Add Color")
        $('#color_form').attr('action', create_url);
        $('#color_form').find("input[type=text], textarea").val("");
        $('#color_form').find('input[name="_method"]').remove();
        $('#modal_form').modal('show')
    })
})
</script>

<script type="text/javascript">
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const create_url ='{{ route("color.store",":id") }}';
    const edit_url ='{{ route("color.show",":id") }}';
    const update_url ='{{ route("color.update",":id") }}';
    const delete_url ='{{ route("color.destroy",":id") }}';

    async function edit_color (color_id) {
        let url_edit = edit_url.replace(':id',color_id);

        result = await get_using_fetch(url_edit);
        form = $('#color_form')
        form.append('<input type="hidden" name="_method" value="PUT">');
        $('#modal_formLabel').text("Edit Color");
        $('#btn_submit').text("Save");
        $('#modal_form').modal('show')

        let url_update = update_url.replace(':id',color_id);
        form.attr('action', url_update);
        form.find('input[name="color"]').val(result.color);
        form.find('input[name="color_code"]').val(result.color_code);
    }

    async function delete_color (color_id) {
        if(!confirm("Apakah anda yakin ingin menghapus Cutting Order Record ini?")) { return false; };

        let url_delete = delete_url.replace(':id',color_id);
        let data_params = { token };

        result = await delete_using_fetch(url_delete, data_params)
        if(result.status == "success"){
            alert(result.message)
            location.reload();
        } else {
            console.log(result.message);
            alert("Terjadi Kesalahan");
        }
    }
</script>

<script type="text/javascript">
    $(function (e) {
        $('#color_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/color-data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'color', name: 'color'},
                {data: 'color_code', name: 'color_code'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            // dom: 'Bfrtip',
            // dom: '<"wrapperx"flipt>',
            // dom: '<"top"i>rt<"bottom"flp><"clear">',
            // dom: '<"top"i>rt<"bottom"flp><"clear">',
            // dom:    "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'l><'col-sm-12 col-md-3'f>>" +
            //         "<'row'<'col-sm-12'tr>>" +
            //         "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            // buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'],
            // paging: true,
            lengthChange: true,
            searching: true,
            // ordering: true,
            // info: true,
            autoWidth: false,
            responsive: true,
        });
        // }).buttons().container().appendTo('#color_table_wrapper .col-md-6:eq(0)');

    });
    
</script>
@endpush