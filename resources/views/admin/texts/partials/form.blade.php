{{ csrf_field() }}

<div class="form-group">
    <label for="keyword" class="col-md-4 control-label">Keyword</label>

    <div class="col-md-6">
        <input id="keyword" type="text" class="form-control" name="keyword" value="{{ $text->keyword or old('keyword') }}" required>
    </div>
</div>

<div class="form-group">
    <label for="text" class="col-md-4 control-label">Text</label>

    <div class="col-md-6">
        <input id="text" type="text" class="form-control" name="text" value="{{ $text->text or old('text') }}" required>
    </div>
</div>

