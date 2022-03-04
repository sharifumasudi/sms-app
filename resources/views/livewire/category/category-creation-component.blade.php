<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Category Register') }}</h4>
                </div>
                <div class="card-body">
                    @if($errorException)
                    <div class="alert alert-danger">
                        {{ $errorException }}
                    </div>
                    @endif
                    <div class="basic-form">
                        <form wire:submit.prevent='categoryCreation' method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="cate_name">{{ __('Category name') }}</label>
                                <input wire:model.debounce.500ms='cate_name' type="text" class="form-control input-default @error('cate_name') is-invalid
                                @enderror" is-invalid placeholder="{{ __('Enter Category Name') }}">
                                @error('cate_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc">{{ __('Description') }}</label>
                                <textarea wire:model.debounce.500ms='cate_description' class="form-control @error('cate_description') is-invalid
                                @enderror" rows="4" id="desc" placeholder="{{ __('Enter Category Descritpion..') }}"></textarea>
                                @error('cate_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
