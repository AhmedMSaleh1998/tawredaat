@extends('Company.index')
@section('reports-active', 'm-menu__item--active m-menu__item--open')
@section('reports-pdfs-active', 'm-menu__item--active m-menu__item--open')
@section('page-title', 'Reports|PDFs Donloads')
@section('content')
    <style type="text/css">
        .swal2-confirm {
            background: #3085d6 !important;
        }

        .swal2-cancel {
            background: #f12143 !important;
            color: #fff;
        }
    </style>
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div style="display: none;"
                     class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30"
                     role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation m--font-brand"></i>
                    </div>
                </div>
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    View all PDF downloads
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable"
                               id="users_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User name</th>
                                <th>User phone</th>
                                <th>User Email</th>
                                <th>PDF Downloaded</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody id="categories_info">
                            @if(count($pdfs) > 0)
                                @foreach ($pdfs as $pdf)
                                    <tr>
                                        <td>{{ ($loop->index + 1) }}</td>
                                        <td>{{ $pdf->user? $pdf->user->name: 'Anonymous'}}</td>
                                        <td>{{ $pdf->user? $pdf->user->phone: 'Anonymous'}}</td>
                                        <td>{{ $pdf->user? $pdf->user->email: 'Anonymous' }}</td>
                                        <td>{{ $pdf->user? $pdf->pdf: 'Anonymous' }}</td>
                                        <td>{{ $pdf->created_at->format('d-M-Y') }}</td>
                                        <td>{{ date('h:i A', strtotime($pdf->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="7" class="text-center">There are no pdfs downloads.</td>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
@section('script')
    <script type="text/javascript">
        $('#users_datatable').DataTable(
            {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        filename: 'PDF downloads',
                    }
                ]
            });
    </script>
@endsection
@endsection
<!-- end:: Body -->
