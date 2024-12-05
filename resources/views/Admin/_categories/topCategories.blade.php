@extends('Admin.index')
@section('categories-active', 'm-menu__item--active m-menu__item--open')
@section('brands-create-active', 'm-menu__item--active')
@section('page-title', 'Brands|Create')
@section('content')

<style type="text/css">

::-webkit-file-upload-button {
  background-color: #5867dd;
  border: 1px solid #5867dd;
  border-radius: 5px;
  color: #fff;
  padding: 2px;

}
.invalid-feedback{
    display: block;
}
	    .bootstrap-tagsinput {
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    display: block;
    padding: 4px 6px;
    color: #555;
    vertical-align: middle;
    border-radius: 4px;
    max-width: 100%;
    line-height: 22px;
    cursor: text;
}
.bootstrap-tagsinput input {
    border: none;
    box-shadow: none;
    outline: none;
    background-color: transparent;
    padding: 0 6px;
    margin: 0;
    width: auto;
    max-width: inherit;
}
    .tag{
        background: #888;
        padding:2px;
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
                        Category Top Brands
                    </h3>
                </div>
            </div>
          </div>
          <!-- END: Subheader -->
          <div class="m-content">
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
				<div class="m-content">
					<div class="row">
						<div class="col-lg-12">
							<!--begin::Portlet-->
							<div class="m-portlet">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<span class="m-portlet__head-icon m--hide">
												<i class="la la-gear"></i>
											</span>
											<h3 class="m-portlet__head-text">
												 Top Brand
											</h3>
										</div>
									</div>
								</div>
								<!--begin::Form-->
              @if(isset($oldCategories))
								<form method="POST" action="{{route('category.topCategories.update')}}" 
                class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
									@csrf

									<div class="m-portlet__body">										
										<div class="form-group m-form__group row">
											<div class="col-lg-6">
                        <input type="hidden" name="category_id" value="{{$category_id}}"/>
                        @foreach($oldCategories as  $value)
                        <label>{{ 'Category ' . $value->order }}</label>
												<select class="form-control m-input" name="{{'category_'.$value->order}}" required>
													@foreach($categories as $category)
                              <option value="{{ $category->id }}" @if($category->id == $value->child_category_id) selected @endif>{{ $category->name }}</option>
												  	@endforeach
												</select>
                      @endforeach

                              @if($errors->has('category_one'))
                                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('category_one') }}</strong></span>
                              @endif
											</div>  
                    </div>
                  </div>   
									<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
										<div class="m-form__actions m-form__actions--solid">
											<div class="row">
												<div class="col-lg-6">
												</div>
												<div class="col-lg-6 m--align-right">
													<button type="submit" class="btn btn-primary">Save</button>
												</div>
											</div>
										</div>
									</div>
								</form>
              @else

                <form method="POST" action="{{route('category.topCategories.store')}}" 
                class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
									@csrf

									<div class="m-portlet__body">										
										<div class="form-group m-form__group row">
											<div class="col-lg-6">
                        <input type="hidden" name="category_id" value="{{$category_id}}"/>
                        <label>Category One</label>

                        <select class="form-control m-input" name="category_one" required>
													@foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
												  	@endforeach
												</select>

                        <label>Category Two</label>
												<select class="form-control m-input" name="category_two" required>
													@foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
												  	@endforeach
												</select>
                        <label>Category Three</label>
                        <select class="form-control m-input" name="category_three" required>
													@foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
												  	@endforeach
												</select>
                        <label>Category Four</label>
												<select class="form-control m-input" name="category_four" required>
													@foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
												  	@endforeach
												</select>
                              @if($errors->has('category_one'))
                                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('category_one') }}</strong></span>
                              @endif
											</div>  
                    </div>
                  </div>    									
									
									<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
										<div class="m-form__actions m-form__actions--solid">
											<div class="row">
												<div class="col-lg-6">
												</div>
												<div class="col-lg-6 m--align-right">
													<button type="submit" class="btn btn-primary">Save</button>
												</div>
											</div>
										</div>
									</div>
								</form>
                @endif
								<!--end::Form-->
							</div>
							<!--end::Portlet-->
						</div>
					</div>
				</div>
				</div>
            <!--End::Section-->
          </div>
        </div>
      </div>
 @push('script')
 <script type="text/javascript">
    $(document).ready(function() {
    	$('.js-example-basic-multiple').select2();
	  $('#description_en').summernote({
        tabsize: 2,
        height: 150
      });
  	$('#description_ar').summernote({
        tabsize: 2,
        height: 150
      });

	});
     $('#keywords_en, #keywords_ar, #keywords_meta_en,#keywords_meta_ar,#products_keywords_ar,#products_keywords_en,#distributors_keywords_ar,#distributors_keywords_en').tagsinput({
        confirmKeys: [13, 188]
      });

      $('.bootstrap-tagsinput').on('keypress', function(e){
        if (e.keyCode == 13){
          e.keyCode = 188;
          e.preventDefault();
        };
      });
</script>
@endpush
@endsection
 <!-- end:: Body -->

