<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
{!! Theme::partial('header') !!}

<div class="app-content-wrap">
    <div class="container-fluid">
        <div class="app-entry-form-wrap">
            <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
                <i class="las la-file-alt app-sec-title-icon"></i>
                <h2>Invoices</h2>
            </div>
            <div class="container-fluid">
                <div class="card card-datatable">
                    <div class="card-body" id="item-list">
                        @include('order::buyer.invoice.more')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$(document).ready(function(){
    $("#advanced_table").DataTable({
        responsive: true,
        select: true,
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['nosort']
        }]
    });
});

</script>
    