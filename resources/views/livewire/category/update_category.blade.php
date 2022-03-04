<div wire:ignore class="modal fade" id="example1ModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Receiver Category Edition') }}</h5>
                <button wire:click='close()' type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form wire:submit.prevent='categoryUpdate()' method="POST">
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
