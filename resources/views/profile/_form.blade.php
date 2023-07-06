<?php
/**
 * @var \App\Models\Post $post
 */
?>
<div class="form-group">
    <label class="form-label">
        {{ __('Заголовок') }}
    </label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
           value="{{ isset($post) ? $post->getTitle() : null}}">
    @error('title')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>
<div class="form-group mt-3">
    <label class="form-label">
        {{ __('Краткое описание') }}
    </label>
    <input type="text" class="form-control @error('short_description') is-invalid @enderror" name="short_description"
           value="{{ isset($post) ? $post->getShortDescription() : null}}">
    @error('short_description')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>
<div class="form-group mt-3">
    <label for="textarea-post" class="form-label">
        {{ __('Текст') }}
    </label>
    <textarea id="textarea-post" name="text"
              class="form-control @error('text') is-invalid @enderror">{{ isset($post) ? $post->getText() : null}}</textarea>
    @error('text')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>
<div class="form-group mt-3">
    <label class="form-label">
        {{ __('Обложка') }}
    </label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')
    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>