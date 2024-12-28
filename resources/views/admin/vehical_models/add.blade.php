<form id="editable-form" action="{!! route('admin.models.store') !!}" method="POST">
    @csrf
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Add Model </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="modal_form">
        <div class="form-group">
            <lable>Brand</lable>
            <select name="brand_id" class="form-control">
              <option value="">Select Brand</option>
              @foreach (App\Models\Brand::pluck('name','id') as $key => $brand)
              <option value="{!! $key !!}">{!! $brand !!}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <lable>Name</lable>
            <input type="text" name="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="form-group">
            <lable>Status</lable>
            <select name="status" class="form-control">
              <option value="0">InActive</option>
              <option value="1">Active</option>
            </select>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <a href="javascript:;" type="submit" class="btn btn-primary btn-submit" data-type="details">Save changes</a>
    </div>
    </form>
