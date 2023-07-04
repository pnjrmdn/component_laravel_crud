<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table_activity').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ url('activityAjax') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name_activity',
                    name: 'Name Activity'
                }, {
                    data: 'user_handle',
                    name: 'User Handle'
                }, 
                {
                    data: 'aksi',
                    name: 'Aksi'
                },
            ]
        });
    });

    // GLOBAL SETUP 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // 02_PROSES SIMPAN 
    $('body').on('click', '.tombol-tambah', function(e) {
        e.preventDefault();
        $('#exampleModal').modal('show');
        $('.tombol-simpan').click(function() {
            simpan();
        });
    });

    // 03_PROSES EDIT 
    $('body').on('click', '.tombol-edit', function(e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'activityAjax/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#exampleModal').modal('show');
                $('#name_activity').val(response.result.name_activity);
                $('#user_handle').val(response.result.user_handle);
                console.log(response.result);
                $('.tombol-simpan').click(function() {
                    simpan(id);
                });
            }
        });
    });

    // 04_PROSES Delete 
    $('body').on('click', '.tombol-del', function(e) {
        if (confirm('Yakin mau hapus data ini?') == true) {
            var id = $(this).data('id');
            $.ajax({
                url: 'activityAjax/' + id,
                type: 'DELETE',
            });
            $('#table_activity').DataTable().ajax.reload();
        }
    });

    // fungsi validasi simpan dan update
    function simpan(id = '') {
        if (id == '') {
            var var_url = 'activityAjax';
            var var_type = 'POST';
        } else {
            var var_url = 'activityAjax/' + id;
            var var_type = 'PUT';
        }
        $.ajax({
            url: var_url,
            type: var_type,
            data: {
                name_activity: $('#name_activity').val(),
                user_handle: $('#user_handle').val()
            },
            success: function(response) {
                if (response.errors) {
                    console.log(response.errors);
                    $('.alert-danger').removeClass('d-none');
                    $('.alert-danger').html("<ul>");
                    $.each(response.errors, function(key, value) {
                        $('.alert-danger').find('ul').append("<li>" + value +
                            "</li>");
                    });
                    $('.alert-danger').append("</ul>");
                } else {
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').html(response.success);
                }
                $('#table_activity').DataTable().ajax.reload();
            }

        });
    }

    $('#exampleModal').on('hidden.bs.modal', function() {
        $('#name_activity').val('');
        $('#user_handle').val('');

        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });
</script>
