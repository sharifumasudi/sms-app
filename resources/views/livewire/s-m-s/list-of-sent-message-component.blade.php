<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('SMS SENT') }}</h4>
                    <a href="{{ route('sms.new.sms') }}" class="float-right btn btn-primary"><i class="fa fa-plus-circle"></i> {{ __('New SMS') }}</a>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }} font-weght-bolder">{{ Session::get('message') }}</p>
                    @endif
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Sender') }}</th>
                                    <th>{{ __('Receiver') }}</th>
                                    <th>{{ __('Content') }}</th>
                                    <th>{{ __('Date Sent') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ((array)json_decode($sms) as $key => $dataItems)
                                <tr>
                                    <td>{{ $key+1; }}</td>
                                    <td>{{ $dataItems->fullname }}</td>
                                    <td>{{ $dataItems->name }}</td>
                                    <td>{{ $dataItems->sms_description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($dataItems->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <button wire:click="deleteSMS('{{ Crypt::encrypt($dataItems->sentsms_id) }}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
