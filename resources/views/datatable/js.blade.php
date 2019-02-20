    {{ Html::script('https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js') }}


    <script>
        $.extend( true, $.fn.dataTable.defaults, {
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data perhalaman",
                "emptyTable":  "Tidak ada data",
                "zeroRecords": "Tidak ada data ditemukan",
                "info": "Data ke _START_ - _END_ dari total _TOTAL_ data",
                "infoEmpty": "Data tidak ditemukan",
                "infoFiltered": "(di filter dari _MAX_ data)",
                "processing":     "Processing...",
                "search":         "Pencarian:",
                "paginate": {
                    "first":      "Pertama",
                    "last":       "Terakhir",
                    "next":       "Selanjutnya",
                    "previous":   "Sebelumnya"
                }
            }
        } );
    </script>


