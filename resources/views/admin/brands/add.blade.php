<form id="editable-form" action="{!! route('admin.brands.store') !!}" method="POST">
    @csrf
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Add Brand </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="modal_form">
        <div class="form-group">
            <lable>Category</lable>
            <select name="category_id" class="form-control">
              <option value="">Select Category</option>
              @foreach (App\Models\Category::pluck('name','id') as $key => $category)
                <option value="{!! $key !!}">{!! $category !!}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
          <lable>Name</lable>
          <input type="text" name="name" class="form-control" placeholder="Brand Name" required>
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
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <a href="javascript:;" type="submit" class="btn btn-primary btn-submit" data-type="brands">Save changes</a>
    </div>
    </form>
