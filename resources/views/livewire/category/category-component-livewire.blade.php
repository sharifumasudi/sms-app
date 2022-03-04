<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Categories') }}</h4>
                    <a href="{{ route('sms.category.create') }}" class="float-right btn btn-primary"><i class="fa fa-plus-circle"></i> {{ __('New Category') }}</a>
                </div>
                <div class="card-body">
                    @include('livewire.category.update_category')
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Category Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Total Receiver') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ((array)json_decode($cates) as $key => $dataItems)
                                <tr>
                                    <td>{{ $key+1; }}</td>
                                    <td>{{ $dataItems->cate_name }}</td>
                                    <td>{{ $dataItems->cate_description }}</td>
                                    <td>{{ App\Models\SMS\ReceiversModel::where('category_id', $dataItems->category_id)->count() }}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#example1ModalCenter" wire:click='editCategory({{ $dataItems->category_id }})' class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                        <button wire:click='deleteCategory({{ $dataItems->category_id }})' class="btn btn-danger btn-sm mt-1"><i class="fa fa-trash"></i></button>
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
