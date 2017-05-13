<div class="field">
    <label>Category</label>
    <select name="restaurant_category_id" class="ui search selection dropdown category-dropdown">
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option {{ isset($restaurant) && $category->id == $restaurant->restaurant_category_id  ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <p class="help-block"> {!! ($errors->has('restaurant_category_id') ? $errors->first('restaurant_category_id') : '') !!}</p>
</div>
<div class="field">
    <label>Name</label>
    {!! Form::text('name') !!}
    <p class="help-block">{!! ($errors->has('name') ? $errors->first('name') : '') !!}</p>
</div>
<div class="field">
    <label>Latitude</label>
    {!! Form::text('latitude') !!}
    <p class="help-block">{!! ($errors->has('latitude') ? $errors->first('latitude') : '') !!}</p>
</div>
<div class="field">
    <label>Longitude</label>
    {!! Form::text('longitude') !!}
    <p class="help-block">{!! ($errors->has('longitude') ? $errors->first('longitude') : '') !!}</p>
</div>

@section('script')
    <script>
        $(document).ready(function () {
            const categoryDropdown  = $('.category-dropdown');
            categoryDropdown.dropdown({forceSelection: false});
        });
    </script>
@endsection