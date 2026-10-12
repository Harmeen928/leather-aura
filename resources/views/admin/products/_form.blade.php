<form class="card" method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if (($method ?? 'POST') !== 'POST') @method($method) @endif

    <div class="grid2">
        <div class="full">
            <label>Product Picture {{ $product->exists ? '(selecting a new one replaces the current picture)' : '*' }}</label>
            <img id="preview" class="preview" src="{{ $product->image_url ?: 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' }}" alt="">
            <input type="file" name="image" accept="image/jpeg,image/png,image/webp" {{ $product->exists ? '' : 'required' }}
                   onchange="if(this.files[0]){document.getElementById('preview').src=URL.createObjectURL(this.files[0])}">
            <div class="hint">JPG, PNG or WEBP, maximum 5 MB. A portrait (vertical) photo looks best.</div>
            @error('image')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="full">
            <label>Product Name *</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" maxlength="100" required>
            @error('name')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Headline Line 1</label>
            <input type="text" name="line1" value="{{ old('line1', $product->line1) }}" maxlength="40" placeholder="e.g. WEAR THE">
            @error('line1')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div>
            <label>Headline Line 2 (orange)</label>
            <input type="text" name="line2" value="{{ old('line2', $product->line2) }}" maxlength="40" placeholder="e.g. LEGEND.">
            @error('line2')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div class="full hint" style="margin-top:-8px">If you leave the headline empty, the product name is used as the main headline.</div>

        <div class="full">
            <label>Short Description</label>
            <textarea name="description" rows="3" maxlength="400">{{ old('description', $product->description) }}</textarea>
            @error('description')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div>
            <label>Display Order</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $product->sort_order) }}">
            <div class="hint">A smaller number is shown first.</div>
        </div>
        <div style="align-self:end">
            <input type="hidden" name="is_active" value="0">
            <label class="chk"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}> Show on website</label>
        </div>
    </div>

    <div class="row" style="margin:22px 0 0">
        <a class="btn ghost" href="{{ route('admin.products.index') }}">Cancel</a>
        <button class="btn" type="submit">Save Product</button>
    </div>
</form>
