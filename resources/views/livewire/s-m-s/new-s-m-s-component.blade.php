<div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Sending New SMS To Customers') }}</h4>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('New SMS') }}</h4>
                    </div>
                    <div class="card-body">
                        @if($errorException)
                        <div class="alert alert-danger">
                            {{ $errorException }}
                        </div>
                        @endif
                        @error('error')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="basic-form">
                            <form wire:submit.prevent='smsSender()' method="POST">
                                @csrf
                                <div class="form-group" wire:ignore>
                                    <label for="category_id">{{ __('Receiver Category') }}</label>
                                    <select wire:model.defer='category_id' class="form-control form-control select2 @error('category_id') is-invalid @enderror">
                                        <option value="" selected>{{ __('...') }}</option>
                                        <option value="all" >{{ __("All") }}</option>
                                        @foreach ((array)json_decode($data) as $data )
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
                                    <label for="desc">{{ __('Message') }}</label>
                                    <textarea wire:model.debounce.500ms='message' class="form-control @error('message') is-invalid
                                    @enderror" rows="4" id="desc" placeholder="{{ __('Enter Message Descritpion..') }}"></textarea>
                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-smile-o mr-2"></i>{{ __('Send') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
