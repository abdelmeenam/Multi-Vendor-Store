
<div class="form-group">
    <x-form.input label="Category Name" class="form-control-lg" role="input" name="name" :value="$category->name" />
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
    @enderror
</div>

<div class="form-group">
    <label for="">Description </label>
    <x-form.textarea name="description" :value="$category->description" />
</div>

<div class="form-group">

    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />

    @if($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
    @endif
    @error('image')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
    @error('status')
    <div class="text-danger">
        {{$errors->first('status')}}
    </div>
    @enderror
</div>

<div class="form-group">
    <button type="submit"  class="btn btn-primary">{{$button_label?? 'Save'}}</button>
</div>
