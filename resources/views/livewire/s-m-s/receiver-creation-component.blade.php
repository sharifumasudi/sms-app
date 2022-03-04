<div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('SMS Receiver Registration') }}</h4>
                </div>
                <div class="card-body">
                    @if($errorException)
                    <div class="alert alert-danger">
                        {{ $errorException }}
                    </div>
                    @endif
                    <form wire:submit.prevent='receiverCreation()' method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="fullname">{{ __('Full Name') }}</label>
                                <input wire:model.debounce.delay='name' type="text" class="form-control input-default @error('name') is-invalid @enderror" placeholder="{{ __('Enter Full Name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone">{{ __('Phone Number') }}</label>
                                <input wire:model.debounce.delay='phone' type="text" class="form-control input-default @error('phone') is-invalid
                                @enderror" placeholder="{{ __('Enter Receiver Phone Number') }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="category_id">{{ __('Receiver Category') }}</label>
                            <select wire:model.defer='category_id' class="form-control form-control select2 @error('category_id') is-invalid @enderror">
                                <option value="" selected>{{ __("Choose Receiver Category") }}</option>
                                @foreach ((array)json_decode($catgoriesData) as $data )
                                <option value="{{ Crypt::encrypt($data->category_id) }}">{{ $data->cate_name }}</option>
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
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('.select2').select2();

         $(document).on('change', '.select2', function (e) {
             //when ever the value of changes this will update your PHP variable
            @this.set('category_id', e.target.value);
        });
    });
</script>
@endpush
