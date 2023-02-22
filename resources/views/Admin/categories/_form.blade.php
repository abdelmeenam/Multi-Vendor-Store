
<div class="form-group">
    <label for="Category Name">Category Name </label>
    <input type="text" value="{{ old('name' , $category->name) }}" name="name" @class (['form-control' , 'is-invalid' => $errors->has('name')])>
    @error('parent_id')
    <div class="text-danger">
        {{$message}}
    </div>
    @endif
</div>

<div class="form-group">
    <label for="Category Parent">Category Parent </label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}"@selected(old('parent->id' , $category->parent_id) == $category->parent_id ) >{{$parent->name}}</option>
        @endforeach
    </select>
    @error('parent_id')
    <div class="text-danger">
        {{$errors->first('parent_id')}}
    </div>
    @endif
</div>

<div class="form-group">
    <label for="">Description </label>
    <textarea type="text" name="description" class="form-control">{{old('description' , $category->description)}} </textarea>

</div>

<div class="form-group">
    <label for="">Iamge</label>
    <input type="file" name="image" class="form-control">
    @if($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
    @endif
    @error('image')
    <div class="text-danger">
        {{$message}}
    </div>
    @endif
</div>

<div class="form-group">
    <label for="">Status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status"  value="active" @checked(old('status' , $category->status) == 'active')>
        <label class="form-check-label" >
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status"  value="archived" @checked(old('status' , $category->status)=='archived')>
        <label class="form-check-label" >
            Archived
        </label>
    </div>
    @error('status')
    <div class="text-danger">
        {{$errors->first('status')}}
    </div>
    @endif
</div>

<div class="form-group">
    <button type="submit"  class="btn btn-primary">{{$button_label?? 'Save'}}</button>
</div>
