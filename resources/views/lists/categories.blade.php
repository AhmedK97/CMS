<option selected>اختر التصنيف المناسب</option>

@if (!isset($post))
    @foreach ($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->title }}
        </option>
    @endforeach
@else
    @foreach ($categories as $category)
        <option {{ $post->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
            {{ $category->title }}
        </option>
    @endforeach
@endif
