<form id="editable-form" action="{!! route('admin.vehicals.update',array($vehical->id)) !!}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Edit Details </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="modal_form">
      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{!! $vehical->title !!}" placeholder="Title" required>
    </div><div class="form-group">
        <label>Category</label>
        <select name="category_id" id="CategoryId" class="form-control" required>
            <option value="">Select</option>
            @foreach (App\Models\Category::pluck('name','id')->toArray() as $id => $name)
                <option value="{!! $id !!}" {!! $id == $vehical->category_id ? 'selected' : '' !!}>{!! $name !!}</option>
            @endforeach
        </select>
    </div><div class="form-group">
        <label>Brand</label>
        <select name="brand_id" id="BrandId" class="form-control" required>
            <option value="">Select</option>
            <option value="{!! $vehical->brand_id !!}" selected>{!! $vehical->brand->name !!}</option>
        </select>
        <label>Model</label>
        <select name="model_id" id="ModelId" class="form-control" required>
            <option value="">Select</option>
            <option value="{!! $vehical->model_id !!}" selected>{!! $vehical->vehical_model->name !!}</option>
        </select>
        <label>Mfg. Year</label>
        <select name="year" id="Year" class="form-control" required>
            <option value="">Select</option>
            @for ($i=0;$i < date('y');$i++)
                <option value={!! Carbon\Carbon::now()->subYear($i)->format('Y') !!} {!! Carbon\Carbon::now()->subYear($i)->format('Y') == $vehical->year ? 'selected' : '' !!}>{!! Carbon\Carbon::now()->subYear($i)->format('Y') !!}</option>
            @endfor
        </select>
        <label>Fuel</label>
        <select name="fuel" id="Fuel" class="form-control" required>
            <option value="">Select</option>
            @foreach (App\Models\Vehical::$fules as $key => $value)
            <option value="{!! $key !!}" {!! $key == $vehical->fuel ? 'selected' : '' !!}>{!! $value !!}</option>
            @endforeach
        </select>
        <label>Mileage</label>
        <input type="text" name="mileage" class="form-control" value="{!! $vehical->mileage !!}" placeholder="Mileage" required>
        <label>Color</label>
        <input type="text" name="color" class="form-control" value="{!! $vehical->color !!}" placeholder="Color" required>
        <label>Price</label>
        <input type="text" name="price" class="form-control" value="{!! $vehical->price !!}" placeholder="Price" required>
        <label>Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="description">{!! $vehical->description !!}</textarea>
    </div>
    </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <a href="javascript:;" type="submit" class="btn btn-primary btn-submit" data-id="vehicals_{!! $vehical->id !!}">Save changes</a>
    </div>
    </form>
    <script>
        var options = {
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            allowedContent:true
        };
        $(document).ready(function() {
            var editor = CKEDITOR.replace( 'description',options);
        });
        </script>
