<div wire:ignore class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Receiver Edition') }}</h5>
                <button wire:click='close()' type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='update()' method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fullname">{{ __('Full Name') }}</label>
                        <input wire:model.debounce.delay='name' type="text" class="form-control input-default @error('name') is-invalid @enderror" placeholder="{{ __('Enter Full Name') }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ __('Phone Number') }}</label>
                        <input wire:model.debounce.delay='phone' type="text" class="form-control input-default @error('phone') is-invalid
                        @enderror" placeholder="{{ __('Enter Receiver Phone Number') }}">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label for="category_id">{{ __('Receiver Category') }}</label>
                        <select wire:model.defer='category_id' class="form-control form-control select2 @error('category_id') is-invalid @enderror">
                            <option value="" selected>{{ __("Choose Receiver Category") }}</option>
                            @foreach ((array)json_decode($catgoriesData) as $data )
                            <option value="{{ $data->category_id }}">{{ $data->cate_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
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
