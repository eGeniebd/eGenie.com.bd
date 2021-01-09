@extends('backend.layouts.app')
@section('content')


<div class="card">
	<div class="card-header">
		<h6 class="fw-600 mb-0">{{ translate('Home Page Settings') }}</h6>
	</div>
	<div class="card-body">
		<div class="row gutters-10">
			{{-- Home Slider --}}
			<div class="col-lg-6">
				<div class="card shadow-none bg-light">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Home Slider') }}</h6>
					</div>
					<div class="card-body">
						<div class="alert alert-info">
							{{ translate('We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.') }}
						</div>
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label>{{ translate('Photos & Links') }}</label>
								<div class="home-slider-target">
									<input type="hidden" name="types[]" value="home_slider_images">
									<input type="hidden" name="types[]" value="home_slider_links">
									@if (get_setting('home_slider_images') != null)
										@foreach (json_decode(get_setting('home_slider_images'), true) as $key => $value)
											<div class="row gutters-5">
												<div class="col-5">
													<div class="input-group" data-toggle="aizuploader" data-type="image">
						                                <div class="input-group-prepend">
						                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
						                                </div>
						                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
														<input type="hidden" name="types[]" value="home_slider_images">
						                                <input type="hidden" name="home_slider_images[]" class="selected-files" value="{{ json_decode(get_setting('home_slider_images'), true)[$key] }}">
						                            </div>
						                            <div class="file-preview box sm">
						                            </div>
												</div>
												<div class="col">
													<div class="form-group">
														<input type="hidden" name="types[]" value="home_slider_links">
														<input type="text" class="form-control" placeholder="http://" name="home_slider_links[]" value="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
													</div>
												</div>
												<div class="col-auto">
													<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
														<i class="las la-times"></i>
													</button>
												</div>
											</div>
										@endforeach
									@endif
								</div>
								<button
									type="button"
									class="btn btn-soft-secondary btn-sm"
									data-toggle="add-more"
									data-content='
									<div class="row gutters-5">
										<div class="col-5">
											<div class="input-group" data-toggle="aizuploader" data-type="image">
												<div class="input-group-prepend">
													<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
												</div>
												<div class="form-control file-amount">{{ translate('Choose File') }}</div>
												<input type="hidden" name="types[]" value="home_slider_images">
												<input type="hidden" name="home_slider_images[]" class="selected-files">
											</div>
											<div class="file-preview box sm">
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_slider_links">
												<input type="text" class="form-control" placeholder="http://" name="home_slider_links[]">
											</div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>'
									data-target=".home-slider-target">
									{{ translate('Add New') }}
								</button>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			{{-- Home categories--}}
			<div class="col-lg-6">
				<div class="card shadow-none bg-light">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Home Categories') }}</h6>
					</div>
					<div class="card-body">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label>{{ translate('Categories') }}</label>
								<div class="home-categories-target">
									<input type="hidden" name="types[]" value="home_categories">
									@if (get_setting('home_categories') != null)
										@foreach (json_decode(get_setting('home_categories'), true) as $key => $value)
											<div class="row gutters-5">
												<div class="col">
													<div class="form-group">
														<select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" required>
							                                @foreach (\App\Category::all() as $key => $category)
							                                    <option value="{{ $category->id }}" @if( $value == $category->id) selected @endif>{{ $category->getTranslation('name') }}</option>
							                                @endforeach
							                            </select>
													</div>
												</div>
												<div class="col-auto">
													<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
														<i class="las la-times"></i>
													</button>
												</div>
											</div>
										@endforeach
									@endif
								</div>
								<button
									type="button"
									class="btn btn-soft-secondary btn-sm"
									data-toggle="add-more"
									data-content='<div class="row gutters-5">
										<div class="col">
											<div class="form-group">
												<select class="form-control aiz-selectpicker" name="home_categories[]" data-live-search="true" required>
													@foreach (\App\Category::all() as $key => $category)
														<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>'
									data-target=".home-categories-target">
									{{ translate('Add New') }}
								</button>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			{{-- Home Banner 1 --}}
			<div class="col-lg-6">
				<div class="card shadow-none bg-light">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Home Banner 1 (Max 3)') }}</h6>
					</div>
					<div class="card-body">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label>{{ translate('Banner & Links') }}</label>
								<div class="home-banner1-target">
									<input type="hidden" name="types[]" value="home_banner1_images">
									<input type="hidden" name="types[]" value="home_banner1_links">
									@if (get_setting('home_banner1_images') != null)
										@foreach (json_decode(get_setting('home_banner1_images'), true) as $key => $value)
											<div class="row gutters-5">
												<div class="col-5">
													<div class="input-group" data-toggle="aizuploader" data-type="image">
						                                <div class="input-group-prepend">
						                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
						                                </div>
						                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
														<input type="hidden" name="types[]" value="home_banner1_images">
						                                <input type="hidden" name="home_banner1_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner1_images'), true)[$key] }}">
						                            </div>
						                            <div class="file-preview box sm">
						                            </div>
												</div>
												<div class="col">
													<div class="form-group">
														<input type="hidden" name="types[]" value="home_banner1_links">
														<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]" value="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}">
													</div>
												</div>
												<div class="col-auto">
													<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
														<i class="las la-times"></i>
													</button>
												</div>
											</div>
										@endforeach
									@endif
								</div>
								<button
									type="button"
									class="btn btn-soft-secondary btn-sm"
									data-toggle="add-more"
									data-content='
									<div class="row gutters-5">
										<div class="col-5">
											<div class="input-group" data-toggle="aizuploader" data-type="image">
												<div class="input-group-prepend">
													<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
												</div>
												<div class="form-control file-amount">{{ translate('Choose File') }}</div>
												<input type="hidden" name="types[]" value="home_banner1_images">
												<input type="hidden" name="home_banner1_images[]" class="selected-files">
											</div>
											<div class="file-preview box sm">
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner1_links">
												<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]">
											</div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>'
									data-target=".home-banner1-target">
									{{ translate('Add New') }}
								</button>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			{{-- Home Banner 2 --}}
			<div class="col-lg-6">
				<div class="card shadow-none bg-light">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Home Banner 2 (Max 3)') }}</h6>
					</div>
					<div class="card-body">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label>{{ translate('Banner & Links') }}</label>
								<div class="home-banner2-target">
									<input type="hidden" name="types[]" value="home_banner2_images">
									<input type="hidden" name="types[]" value="home_banner2_links">
									@if (get_setting('home_banner2_images') != null)
										@foreach (json_decode(get_setting('home_banner2_images'), true) as $key => $value)
											<div class="row gutters-5">
												<div class="col-5">
													<div class="input-group" data-toggle="aizuploader" data-type="image">
						                                <div class="input-group-prepend">
						                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
						                                </div>
						                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
														<input type="hidden" name="types[]" value="home_banner2_images">
						                                <input type="hidden" name="home_banner2_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner2_images'), true)[$key] }}">
						                            </div>
						                            <div class="file-preview box sm">
						                            </div>
												</div>
												<div class="col">
													<div class="form-group">
														<input type="hidden" name="types[]" value="home_banner2_links">
														<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]" value="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}">
													</div>
												</div>
												<div class="col-auto">
													<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
														<i class="las la-times"></i>
													</button>
												</div>
											</div>
										@endforeach
									@endif
								</div>
								<button
									type="button"
									class="btn btn-soft-secondary btn-sm"
									data-toggle="add-more"
									data-content='
									<div class="row gutters-5">
										<div class="col-5">
											<div class="input-group" data-toggle="aizuploader" data-type="image">
												<div class="input-group-prepend">
													<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
												</div>
												<div class="form-control file-amount">{{ translate('Choose File') }}</div>
												<input type="hidden" name="types[]" value="home_banner2_images">
												<input type="hidden" name="home_banner2_images[]" class="selected-files">
											</div>
											<div class="file-preview box sm">
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner2_links">
												<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]">
											</div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>'
									data-target=".home-banner2-target">
									{{ translate('Add New') }}
								</button>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			{{-- Home Banner 2 --}}
			<div class="col-lg-12">
				<div class="card shadow-none bg-light">
					<div class="card-header">
						<h6 class="mb-0">{{ translate('Top 10') }}</h6>
					</div>
					<div class="card-body">
						<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
								<label class="col-md-2 col-from-label">{{translate('Top Categories (Max 10)')}}</label>
								<div class="col-md-10">
									<input type="hidden" name="types[]" value="top10_categories">
									<select name="top10_categories[]" class="form-control aiz-selectpicker" multiple data-max-options="10" data-live-search="true" required>
										@foreach (\App\Category::all() as $key => $category)
											<option value="{{ $category->id }}" @if(in_array($category->id, json_decode(get_setting('top10_categories')))) selected @endif>{{ $category->getTranslation('name') }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-from-label">{{translate('Top Brands (Max 10)')}}</label>
								<div class="col-md-10">
									<input type="hidden" name="types[]" value="top10_brands">
									<select name="top10_brands[]" class="form-control aiz-selectpicker" multiple data-max-options="10" data-live-search="true" required>
										@foreach (\App\Brand::all() as $key => $brand)
											<option value="{{ $brand->id }}" @if(in_array($brand->id, json_decode(get_setting('top10_brands')))) selected @endif>{{ $brand->getTranslation('name') }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
		$(document).ready(function(){
		    AIZ.plugins.bootstrapSelect('refresh');
		});
    </script>
@endsection
