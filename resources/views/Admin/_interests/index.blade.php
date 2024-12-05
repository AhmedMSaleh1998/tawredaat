@extends('Admin.index')
@section('interests-active', 'm-menu__item--active m-menu__item--open')
@section('interests-view-active', 'm-menu__item--active')
@section('page-title', 'Interests | View')
@section('content')
<style type="text/css">
  .swal2-confirm{
    background: #3085d6 !important;
  }
  .swal2-cancel{
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
                            <div class="mr-auto">
                    <h3 class="m-subheader__title ">
                        {{$MainTitle}}
                    </h3>
                </div>
            </div>
          </div>
          <!-- END: Subheader -->
        <div class="m-content">
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            {{$SubTitle}}
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item">
                                            <a href="{{route('interests.create')}}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                                <span>
                                                    <i class="la la-plus"></i>
                                                    <span>New Interest</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                            <div class="table-responsive">
                                <!--begin: Datatable -->
                                <table class="table table-striped- table-bordered table-hover table-checkable" id="interests">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name in english</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>

                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
        </div>
      </div>

 @push('script')
 <script type="text/javascript">
  $('#interests').DataTable({
       "processing": true,
       "serverSide": true,
        'paging'      : true,
        'info'        : true,
       "ajax": "{{ route('interests.interests') }}",
       "columns":[
            {
              "data": "id"
             },
            {
              "data": "name"
             },
            {
              "mRender": function ( data, type, row )
              {
                var url = "{{ route('interests.edit','id' ) }}";
                url = url.replace('id', row['id']);
                return '<a class="btn btn-primary"  href='+url+'><i class="fa fa-edit"></i></a> <a style="color:#fff" class="btn btn-danger delete" data-content="'+ row['id']+'"><i class="fa fa-trash"></i></a>';
              },
               sortable: false,
               searchable: false,
            }
        ]
    }).ajax.reload();


            //Delete payments data
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("#interests").on('click', '.delete', function(){
           Swal.fire({
             title: 'Are you sure to delete this interest data ?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                var content = $( this ).data( "content" );
                var urls = "{{ route('interests.destroy','id' ) }}";
                urls = urls.replace('id', content);
                $.ajax({
                    url: urls,
                    method: 'POST',
                    data: {_token: CSRF_TOKEN, id: content,_method:"delete"},
                    dataType: 'JSON',
                    beforeSend: function(){
                    },
                    success: function (data) {
                       $("#interests").DataTable().ajax.reload();
                        Swal.fire(
                    'Deleted!',
                    'Interests has been deleted.',
                    'success'
                    )
                    }
                    ,error:function(data){
                       $("#interests").DataTable().ajax.reload();
                    }

                });
              }
            });
        });

 </script>
@endpush
@endsection
 <!-- end:: Body -->
