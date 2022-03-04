<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Receiver') }}</h4>
                    <a href="{{ route('sms.receiver.create') }}" class="float-right btn btn-primary"><i class="fa fa-plus-circle"></i> {{ __('New Receiver') }}</a>
                </div>
                <div class="card-body">
                    <p>
                        @include('livewire.s-m-s.update_receiver')
                    </p>
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Full Name') }}</th>
                                    <th>{{ __('Phone No') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ((array)json_decode($receiversModelData) as $key => $dataItems)
                                <tr>
                                    <td>{{ $key+1; }}</td>
                                    <td>{{ $dataItems->name }}</td>
                                    <td>{{ $dataItems->phone }}</td>
                                    <td>{{ $dataItems->cate_name }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#exampleModalCenter" wire:click="editReceiver({{ $dataItems->sms_receiver_id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" wire:click="deletetReceiver({{ $dataItems->sms_receiver_id }})"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
