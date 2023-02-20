<div class="form-group">
    <label for="Category Name">Category Name </label>
    <input type="text" value="{{$category->name}}" name="name" class="form-control">
</div>

<div class="form-group">
    <label for="Category Parent">Category Parent </label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}"@selected($parent->id == $category->parent_id ) >{{$parent->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Description </label>
    <textarea type="text" name="description" class="form-control">{{$category->description}} </textarea>
</div>

<div class="form-group">
    <label for="">Iamge</label>
    <input type="file" name="image" class="form-control">
    @if($category->image)
        <img src="{{ asset('storage/uploads/' . $category->image) }}" alt="" height="50">
    @endif
</div>

<div class="form-group">
    <label for="">Status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status"  value="active" @checked($category->status == 'active')>
        <label class="form-check-label" >
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status"  value="archived" @checked($category->status =='archived')>
        <label class="form-check-label" >
            Archived
        </label>
    </div>
</div>

<div class="form-group">
    <button type="submit"  class="btn btn-primary">{{$button_label?? 'Save'}}</button>
</div>
